<?php

namespace App\Infrastructure\Persistence\Doctrine\DependencyInjection\Compiler;

use Doctrine\ORM\Mapping\Driver\XmlDriver;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class DoctrineMappingPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        $projectDir = $container->getParameter('kernel.project_dir');
        $mappingRootDir = $projectDir . '/src/Infrastructure/Persistence/Doctrine/Mapping';
        $mappings = [];
        $contexts = scandir($mappingRootDir);
        foreach ($contexts as $context) {
            if ($context === '.' || $context === '..') continue;
            $basePath = $mappingRootDir . '/' . $context;
            foreach (['Entity', 'Embeddable'] as $type) {
                $dir = $basePath . '/' . $type;
                if (!is_dir($dir)) continue;
                $subNamespace = $type === 'Entity' ? 'Entity' : 'ValueObject';
                $mappings["App.{$context}.{$type}"] = [
                    'dir' => $dir,
                    'prefix' => "App\\Domain\\{$context}\\{$subNamespace}",
                ];
            }
        }
        $definition = $container->getDefinition('doctrine.orm.configuration');
        foreach ($mappings as $mapping) {
            $xmlDriverDefinition = new \Symfony\Component\DependencyInjection\Definition(XmlDriver::class, [$mapping['dir']]);
            $container->setDefinition('doctrine.orm.mapping_driver.xml_driver', $xmlDriverDefinition);
            $definition->addMethodCall('setMetadataDriverImpl', [
                new Reference('doctrine.orm.mapping_driver.xml_driver')
            ]);
        }
    }
}





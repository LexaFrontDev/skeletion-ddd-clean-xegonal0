<?php

namespace App\Infrastructure\Persistence\Doctrine\Repository\User;

use App\Domain\User\Entity\User;
use App\Domain\User\Persistence\UserGatewayInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository implements UserGatewayInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function save(User $user): User
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();

        return $user;
    }

    public function delete(User $user): void
    {
        $this->getEntityManager()->remove($user);
        $this->getEntityManager()->flush();
    }

    public function getByEmail(string $email): ?User
    {
        /** @var User|null $user */
        $user = $this->findOneBy(['email.value' => $email]);

        return $user;
    }

    public function getByUsername(string $username): ?User
    {
        /** @var User|null $user */
        $user = $this->findOneBy(['username.value' => $username]);

        return $user;
    }

    public function getById(int $id): ?User
    {
        /** @var User|null $user */
        $user = $this->findOneBy(['id' => $id]);

        return $user;
    }

    public function getByIdentifier(int|string $identifier): ?User
    {
        $qb = $this->createQueryBuilder('u');
        $qb->andWhere($qb->expr()->orX(
            $qb->expr()->eq('u.id', ':identifier'),
            $qb->expr()->eq('u.email.value', ':identifier')
        ))
            ->setParameter('identifier', $identifier);

        /** @var User|null $user */
        $user = $qb->getQuery()
            ->setMaxResults(1)
            ->getOneOrNullResult();

        return $user;
    }
}
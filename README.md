Пока разрабатываю
скелет  проекта на Symfony с архитектурой DDD + Clean + Hexagonal.
## Быстрый старт

1. Клонируй репозиторий:
```bash
git clone https://github.com/LexaFrontDev/template-ddd-clean-xegonal.git
cd template-ddd-clean-xegonal
```

2. Измени названия контейнеров и домен в `docker-compose.yml` и `nginx/conf.d/default.conf` под свой `server_name`.

3. Подними Docker:
```bash
docker-compose up -d --build
```

4. Зайди в контейнер PHP:
```bash
docker exec -it <php-container-name> bash
```

5. Установи зависимости:
```bash
composer install
```

6. Добавь домен в `hosts`:
```
127.0.0.1 myproject.local
```

7. Открой в браузере:
```
http://myproject.local
```

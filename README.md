# Инструкция по запуску проекта "Справочник организаций"

---

## Общая информация

Проект реализован на Laravel 12 с использованием REST API. В проекте три основные сущности: Организация, Здание и Деятельность.

---

# Инициализация приложения

## Требования

- Git, Docker и Docker Compose должны быть установлены на вашей машине.

## Шаги запуска

1. Клонируйте репозиторий с проектом:

```shell
git clone https://github.com/aleX13999/OrganizationsHandbook.git
cd <папка_проекта>
```

2. Создайте файл окружения `.env` командой:
```shell
cp .env.example .env
```

3. Отредактируйте `.env`, укажите необходимые настройки (под Docker):
```dotenv
NGINX_HOST=127.0.0.1
NGINX_HTTP_PORT=

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=root
DB_PASSWORD=

MYSQL_HOST=127.0.0.1
MYSQL_PORT=
MYSQL_ROOT_PASSWORD=
MYSQL_DATABASE=
MYSQL_USER=root
MYSQL_PASSWORD=
MYSQL_SERVER_VERSION=8.0

L5_SWAGGER_GENERATE_ALWAYS=true

API_KEY=
```

4. Запустите контейнеры Docker:

```shell
docker compose up -d
```

5. Установите зависимости composer:

```shell
docker exec -it php-fpm composer install
```

6. Выполните миграции:

```shell
docker exec -it php-fpm php artisan migrate
```

7. Заполнить БД тестовыми данными:
```shell
docker exec -it php-fpm php artisan db:seed
```

8. Сгенерируйте ключ приложения:

```shell
docker exec -it php-fpm php artisan key:generate
```

9. Сгенерируйте документацию Swagger:

```shell
docker exec -it oh-php-fpm php artisan l5-swagger:generate
```

### Открыть документацию Swagger можно по маршруту:

```shell
http://localhost:8081/api/doc
```

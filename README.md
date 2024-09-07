## Требования к проекту

- [Docker](https://docs.docker.com/engine/install/).
- [Docker-compose](https://docs.docker.com/compose/install/).

## Как развернуть?

Для удобства в проекте был написан Makefile. Прежде чем перейти к запуску команд необходимо:
 
 - Прописать домен в файле /etc/hosts на вашем устройстве.
 - Добавить файл ./docker/nginx/nginx.conf (в директории лежит файл с примером).

Запускаем команду для сборки контейнеров.
```
make init
```

В дальнейшем можно пользоваться командой для перезапуска контейнеров:
```
make restart
```

Важно, команды необходимо запускать вне контейнера.

После запуска команды необходимо добавить и настроить файл .env. Пример настройки представлен в .env.example.

После настройки необходимо ввести следующие команды:

```
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan passport:install
php artisan passport:set-passport-client-secret
```

## Pint

```
composer pint
```

## Phpstan

```
composer analyse
```

## Генерация докблоков для моделей

```
php artisan ide-helper:models --write-mixin
```

## Роуты для проверки

 - GET    /api/workers                       - Список исполнителей с фильтром
 - POST   /api/order                         - Создать заказ
 - PATCH  /api/order/{order_id}/sync-workers - Прикрепить исполнителей к заказу
 - PATCH  /api/order/{order_id}/status       - Изменить статус заказа
 - GET    /api/auth/me                       - Получить авторизованного пользователя
 - GET    /api/auth/sessions                 - Список сессий пользователя
 - DELETE /api/auth/sessions/{session_id}    - Удалить сессию
 - POST   /api/auth/login                    - Войти в аккаунт
 - POST   /api/auth/logout                   - Выйти из аккаунта

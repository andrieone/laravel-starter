##Installation
- cd docker/docker-compose/docker-desktop
- Create and start container: `docker-compose up -d --build`
- Log in to container: `docker exec -it --user=dev_user laravel6kit_php-fpm bash`
- Create env fie: `cp .env.example .env`
- Run composer install: `composer install`
- Create application key: `php artisan key:generate`
- Run migration and seed: php artisan migrate:fresh --seed
- Access app to http://127.0.0.1:8086
- Access to phpMyAdmin is http://127.0.0.1:8087

##Login to app
http://127.0.0.1:8086/admin/login

Super Admin `admin@admin` `12345678`

Company Admin `company@admin` `12345678`

Company User `user@company` `12345678`


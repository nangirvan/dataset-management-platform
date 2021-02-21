## Requirements

1. PHP 7.4 atau 8.x
2. Composer 2.x
3. SQLite 3.x

## Instalasi

1. Clone repository
2. `composer install`
3. Salin `.env.example` ke `.env`
4. `php artisan key:generate`
5. `php artisan migrate:fresh --seed`
6. `php artisan storage:link`
7. `php artisan serve`

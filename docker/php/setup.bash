cd /srv

composer install
php artisan key:generate
touch database/database.sqlite
php artisan migrate:fresh
php artisan config:clear

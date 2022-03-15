#!/bin/bash -ex

set -ex

touch database/database.sqlite
cd /srv
cp -n .env.example .env
composer install
php artisan key:generate
php artisan migrate:fresh
php artisan db:seed TaskSeeder
php artisan serve --host=0.0.0.0

exec "$@"

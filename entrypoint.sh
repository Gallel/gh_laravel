#!/bin/sh
# Espera a que el host "db" en el puerto 3306 esté disponible
./wait-for-it.sh db:3306 --timeout=60 --strict -- echo "Database is up"

# Ejecuta las migraciones
php artisan migrate --force

# Inicia el servidor de Laravel
php artisan serve --host=0.0.0.0 --port=9000
#php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=9000
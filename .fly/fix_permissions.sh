#!/bin/bash

# Ajustar permissões para o diretório storage
chown -R www-data:www-data /var/www/html/storage
chmod -R 775 /var/www/html/storage

# Ajustar permissões para o diretório bootstrap/cache
chown -R www-data:www-data /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/bootstrap/cache

# Executar o comando original do entrypoint
exec "$@"
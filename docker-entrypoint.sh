#!/bin/sh
set -e

if [ -z "$(ls -A /var/www/html)" ]; then
    cp -R /tmp/html/* /var/www/html/
    chown -R www-data:www-data /var/www/html
    chmod -R 755 /var/www/html
fi

chown -R www-data:www-data /var/www/html
chmod -R 755 /var/www/html

exec "$@"
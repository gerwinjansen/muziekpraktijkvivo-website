#!/bin/sh

set -e

echo "Activating feature 'php-xdebug'"

#See https://xdebug.org/docs/compat and https://xdebug.org/updates
pecl install xdebug-3.1.6
docker-php-ext-enable xdebug

echo 'Done!'

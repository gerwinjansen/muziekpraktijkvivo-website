#!/bin/sh

set -e

echo "Activating feature 'php-xdebug'"

#See https://xdebug.org/docs/compat and https://xdebug.org/updates
pecl install xdebug-3.1.6
cp xdebug.ini /usr/local/etc/php/conf.d/

echo 'Done!'

#!/bin/sh

set -e

echo "Activating feature 'php-xdebug'"

pecl install xdebug-$VERSION
cp xdebug.ini /usr/local/etc/php/conf.d/

echo 'Done!'

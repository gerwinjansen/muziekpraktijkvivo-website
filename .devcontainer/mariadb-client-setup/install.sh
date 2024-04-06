#!/bin/sh

set -e

echo "Activating feature 'mariadb-client-setup'"

cat << EOF > ~/.my.cnf
[client]
host=$HOSTNAME
database=$DATABASE
user=$USERNAME
password=$PASSWORD
EOF

cp restoredatabase.sh /usr/local/bin/restoredatabase
chmod 755 /usr/local/bin/restoredatabase

echo 'Done!'

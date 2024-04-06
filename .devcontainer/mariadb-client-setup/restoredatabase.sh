read -p "This overwrites the complete database. Press any key to continue..."
cat /var/www/muziekpraktijkvivo.sql | sed -E "s~https?://muziekpraktijkvivo.nl~http://localhost~g" | mysql
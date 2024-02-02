FROM wordpress:5.8.3-php7.4-apache as wordpress-dependencies

RUN set -eux; \
    rm -Rf \
    /usr/local/bin/docker-entrypoint.sh \
    /usr/src \
    /var/www/html/*

FROM scratch
COPY --from=wordpress-dependencies / /

COPY --chown=www-data:www-data --chmod=0500 vendor/ /var/www/vendor/
COPY --chown=www-data:www-data --chmod=0500 config/ /var/www/config/
COPY --chown=www-data:www-data --chmod=0500 public_html/ /var/www/html/

RUN set -eux; \
    mkdir /var/www/html/uploads; \
    chown www-data:www-data /var/www/html/uploads; \
    chmod 0700 /var/www/html/uploads;

#USER www-data:www-data
EXPOSE 80
VOLUME /var/www/html/uploads
CMD ["apache2-foreground"]
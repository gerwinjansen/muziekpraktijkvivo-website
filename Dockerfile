FROM wordpress:php8.2-apache AS wordpress-stripped

RUN set -eux; \
    rm -Rf \
    /usr/local/bin/docker-entrypoint.sh \
    /usr/src \
    /var/www/*


FROM scratch AS wordpress-dependencies
COPY --from=wordpress-stripped / /
ENV PHP_INI_DIR=/usr/local/etc/php
ENV APACHE_CONFDIR=/etc/apache2
ENV APACHE_ENVVARS=$APACHE_CONFDIR/envvars
EXPOSE 80
WORKDIR /var/www
CMD ["apache2-foreground"]
#USER www-data:www-data

# Adjust to DirectAdmin directory as used by the hosting provider
RUN sed --in-place 's@DocumentRoot /var/www/html@DocumentRoot /var/www/public_html@g' /etc/apache2/sites-available/000-default.conf

FROM wordpress-dependencies AS wordpress-devcontainer
RUN set -eux; \
    apt-get update; \
    apt-get install -y --no-install-recommends \
        openssh-client \
        git \
        mariadb-client \
        p7zip-full \
    ; \
    rm -rf /var/lib/apt/lists/*


FROM wordpress-dependencies AS muziekpraktijkvivo-website
COPY --chown=www-data:www-data --chmod=0500 vendor/ /var/www/vendor/
COPY --chown=www-data:www-data --chmod=0500 config/ /var/www/config/
COPY --chown=www-data:www-data --chmod=0500 public_html/ /var/www/html/

RUN set -eux; \
    mkdir /var/www/html/uploads; \
    chown www-data:www-data /var/www/html/uploads; \
    chmod 0700 /var/www/html/uploads;

VOLUME /var/www/html/uploads
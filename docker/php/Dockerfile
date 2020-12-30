FROM php:fpm-alpine

COPY wait-for-it.sh /usr/bin/wait-for-it
RUN chmod +x /usr/bin/wait-for-it

#RUN apk add --update git \
#    && apk add --update lib1g-dev \
#    && apk add --update libicu-dev \
#    && apk add --update libpq-dev \
#    && apk add --update libxml2-dev
#
#RUN docker-php-ext-configure intl \
#    && docker-php-ext-install intl \
#    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
#    && docker-php-ext-install pdo pdo_pgsql pgsql \
#    && docker-php-ext-install zip xml
#
#RUN curl --insecure https://getcomposer.org/composer.phar -o /usr/bin/composer && chmod +x /usr/bin/composer

RUN apk --update --no-cache add git

RUN set -ex \
  && apk --no-cache add \
    postgresql-dev

RUN docker-php-ext-install pdo_pgsql

COPY --from=composer /usr/bin/composer /usr/bin/composer

CMD composer install ; wait-for-it database:5432 -- bin/console doctrine:migrations:migrate ;  echo "yes\n" | bin/console doctrine:fixtures:load ; php-fpm

WORKDIR /var/www

EXPOSE 9000

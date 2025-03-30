FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    curl \
    git \
    unzip \
    mariadb-client \
    libmariadb-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN groupadd -g 1000 www && \
    useradd -u 1000 -ms /bin/bash -g www www

WORKDIR /var/www/html

COPY --chown=www:www . /var/www/html/

RUN chown -R www:www /var/www/html && chmod -R 755 /var/www/html

COPY entrypoint.sh /var/www/html/entrypoint.sh
RUN chmod +x /var/www/html/entrypoint.sh

EXPOSE 9000

USER www

ENTRYPOINT ["/var/www/html/entrypoint.sh"]

CMD ["php-fpm"]

FROM php:8.3-cli

WORKDIR /app

# librdkafka
RUN apt-get update && \
    apt-get install -y gnupg software-properties-common && \
    curl -sL https://packages.confluent.io/deb/7.0/archive.key | apt-key add - && \
    add-apt-repository "deb [arch=amd64] https://packages.confluent.io/deb/7.0 stable main" && \
    apt-get update && \
    apt-get install -y librdkafka-dev

# rdkafka
RUN pecl install rdkafka && docker-php-ext-enable rdkafka

# Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); exit(1); } echo PHP_EOL;" && \
    php composer-setup.php --version=2.7.7 --install-dir=/usr/local/bin --filename=composer && \
    php -r "unlink('composer-setup.php');"

# git
RUN apt-get update && apt-get install -y zip unzip git

COPY . .

ENV COMPOSER_ALLOW_PLATFORM_REQS=ext-http
RUN composer update --ignore-platform-req=${COMPOSER_ALLOW_PLATFORM_REQS}

EXPOSE 8080

CMD ["php", "-S", "0.0.0.0:8080", "-t", "/app/public"]

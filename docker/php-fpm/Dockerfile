FROM php:8.2-fpm

WORKDIR "/application"

# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive

ARG HOST_UID=1000
ARG HOST_GID=1000
ENV USERNAME=www-data

ENV COMPOSER_ALLOW_SUPERUSER=1

# Installing tools and PHP extensions using "apt", "docker-php", "pecl"

RUN set -eux; \
        apt-get update; \
        apt-get upgrade -y; \
        apt-get install -y --no-install-recommends \
                curl \
                libpq-dev \
                libonig-dev \
                libzip-dev zip unzip \
                libxml2-dev \
                libmcrypt-dev; \
        apt-get -y install cron; \
        apt-get install -y --no-install-recommends sudo ssh net-tools supervisor procps; \
        apt-get clean; \
        rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

RUN set -eux; \
        pecl install -o -f redis \
        &&  rm -rf /tmp/pear

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql;

RUN set -eux; \
        docker-php-ext-install -j$(nproc) pgsql pdo_pgsql; \
        docker-php-ext-install -j$(nproc) mbstring; \
        docker-php-ext-install -j$(nproc) simplexml; \
        docker-php-ext-install -j$(nproc) xml; \
        docker-php-ext-install -j$(nproc) exif; \
        docker-php-ext-install -j$(nproc) zip

RUN docker-php-ext-enable \
        redis

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql;

# Copy configuration file
COPY ./php-ini-overrides.ini /usr/local/etc/php/conf.d/uploads.ini

COPY ./cron/daily-alerts /etc/cron.d/daily-alerts
RUN /usr/bin/chmod 0644 /etc/cron.d/daily-alerts
RUN /usr/bin/crontab /etc/cron.d/daily-alerts
RUN touch /var/log/cron.log

COPY ./supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY ./start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

RUN chown -R ${USERNAME}:${USERNAME} /application && \
    usermod -u $HOST_UID ${USERNAME} && \
    groupmod -o -g $HOST_GID ${USERNAME}

# Install composer and add its bin to the PATH.
RUN curl -s http://getcomposer.org/installer | php && \
    echo "export PATH=${PATH}:/var/www/html/vendor/bin" >> ~/.bashrc && \
    mv composer.phar /usr/local/bin/composer

ENTRYPOINT ["/usr/local/bin/start.sh"] \

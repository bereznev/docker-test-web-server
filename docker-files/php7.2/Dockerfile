FROM php:7.0-fpm

RUN docker-php-source extract \
    && docker-php-source delete

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
    && docker-php-ext-install -j$(nproc) iconv mcrypt \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd

  # - Core
  # - ctype
  # - curl
  # - date
  # - dom
  # - fileinfo
  # - filter
  # - ftp
  # - hash
  # - iconv
  # - json
  # - libxml
  # - mbstring
  # - mcrypt
  # - mysqlnd
  # - openssl
  # - pcre
  # - PDO
  # - pdo_sqlite
  # - Phar
  # - posix
  # - readline
  # - Reflection
  # - session
  # - SimpleXML
  # - SPL
  # - sqlite3
  # - standard
  # - tokenizer
  # - xml
  # - xmlreader
  # - xmlwriter
  # - zlib
#RUN apt-get update && apt-get install -y \
#          libfreetype6-dev \
#          libjpeg62-turbo-dev \
#          libmcrypt-dev \
#          libpng-dev \
#          g++ \
#      && docker-php-ext-install -j$(nproc) iconv mcrypt bcmath gd pdo pdo_mysql mbstring

RUN pecl install xdebug-2.6.0 && docker-php-ext-enable xdebug

# Configure XDebug
RUN { \
      echo "xdebug.profiler_enable=0"; \
      echo "xdebug.remote_autostart=0"; \
      echo "xdebug.remote_enable=1"; \
      echo "xdebug.max_nesting_level=500"; \
      echo "xdebug.remote_host=192.168.1.10"; \
      echo "xdebug.remote_port=9000"; \
  } | tee -a /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

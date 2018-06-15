FROM php:7.2-fpm

RUN docker-php-source extract \
    && docker-php-source delete

  # Installed: 
  # Core  ctype  curl  date  dom  fileinfo  filter  ftp  hash  iconv  json  libxml  mbstring  mcrypt
  # mysqlnd  openssl  pcre  PDO  pdo_sqlite  Phar  posix  readline  Reflection  session  SimpleXML  SPL
  # sqlite3  standard  tokenizer  xml  xmlreader  xmlwriter  zlib
  #
  # Possible values for ext-name:
  # bcmath bz2 calendar ctype curl dba dom
  # enchant exif fileinfo filter ftp gd gettext
  # gmp hash iconv imap interbase intl json ldap mbstring mysqli oci8 odbc opcache pcntl
  # pdo pdo_dblib pdo_firebird pdo_mysql pdo_oci pdo_odbc pdo_pgsql pdo_sqlite pgsql
  # phar posix pspell
  # readline recode reflection session shmop simplexml snmp
  # soap sockets sodium spl standard sysvmsg sysvsem sysvshm tidy tokenizer
  # wddx xml xmlreader xmlrpc xmlwriter xsl zend_test zip
RUN apt-get update && apt-get install -y \
          libfreetype6-dev \
          libjpeg62-turbo-dev \
          libmcrypt-dev \
          libpng-dev \
          g++ \
          git \
          mc \
          vim \
      && docker-php-ext-install -j$(nproc) iconv bcmath gd mbstring

# Install Postgre PDO
RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

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

# remove unnecessary files
RUN rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

RUN useradd -G www-data -ms /bin/bash deployer
USER deployer
RUN mkdir /home/deployer/.ssh

WORKDIR /app
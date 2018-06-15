FROM ubuntu:16.04

# Performance optimization - see https://gist.github.com/jpetazzo/6127116
# this forces dpkg not to call sync() after package extraction and speeds up install
RUN echo "force-unsafe-io" > /etc/dpkg/dpkg.cfg.d/02apt-speedup
# we don't need an apt cache in a container
RUN echo "Acquire::http {No-Cache=True;};" > /etc/apt/apt.conf.d/no-cache

# Install core
RUN	apt-get update && \
	apt-get install -y --no-install-recommends apt-utils \
		software-properties-common \
		python-software-properties \
		apt-transport-https \
		lsb-release ca-certificates \
		language-pack-sk-base && \
	LC_ALL=C.UTF-8 && \
	apt-get update && \
	apt-get install -y \
		python-setuptools \
		vim \
		mc \
		curl \
		git \
		sudo \
		unzip \
		openssh-server \
		openssl \
		nginx \
		cron \
		wget \
		net-tools \
		python-pip

# install supervisor
# add `sed -i -e "s/chmod=0700/chmod=0770\nchown=root:deployer/g" /etc/supervisor/supervisord.conf`
RUN pip install supervisor && \
    mkdir -p /etc/supervisor/conf.d && \
    echo_supervisord_conf > /etc/supervisor/supervisord.conf && \
    echo "files = /etc/supervisor/conf.d/*.conf" >> /etc/supervisor/supervisord.conf
#ADD supervisord.service /usr/lib/systemd/system/supervisord.service

RUN useradd -G www-data -ms /bin/bash deployer
# remove unnecessary files
RUN rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /var/lib/apt/lists/*

WORKDIR /app

#EXPOSE 443 80
# srart nginx
ENTRYPOINT ["nginx"]

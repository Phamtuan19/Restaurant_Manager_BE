FROM amazonlinux:2

RUN yum -y update
RUN yum -y upgrade
RUN yum -y install curl

# Install Apache2
RUN yum -y install httpd

# Install Remi repositories
RUN yum -y install https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm
RUN yum -y install https://rpms.remirepo.net/enterprise/remi-release-7.rpm
RUN yum -y install yum-utils

# Install PHP v8.1
RUN yum -y install rpl
RUN yum-config-manager --disable 'remi-php*'
RUN yum-config-manager --enable remi-php81
RUN rpl [remi-php81] "[remi-php81]\npriority=1" /etc/yum.repos.d/remi-php81.repo -e
RUN yum -y install php php-{fpm,cli,pear,cgi,common,curl,mbstring,gd,mysqlnd,gettext,bcmath,json,xml,fpm,intl,zip,mysqli,pdo,pgsql,redis}

# Install composer
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer
RUN ln -s /usr/local/bin/composer /usr/bin/composer

# Install Set LANG, Timezone
ENV TZ Asia/Ho_Chi_Minh

WORKDIR /var/www/html

CMD ["/usr/sbin/httpd","-D","FOREGROUND"]
EXPOSE 80

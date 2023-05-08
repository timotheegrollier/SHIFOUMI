FROM debian

RUN apt-get update && apt-get upgrade -y && apt-get install -y apache2 curl
RUN a2enmod proxy_fcgi
RUN a2enmod rewrite
RUN a2enmod proxy_http


COPY ./conf/httpd/shifoumi.conf /etc/apache2/sites-enabled/shifoumi.conf

COPY ./conf/httpd/ports.conf /etc/apache2/ports.conf

COPY ./conf/httpd/apache2.conf /etc/apache2/apache2.conf


RUN a2dissite 000-default



CMD /usr/sbin/apache2ctl -D FOREGROUND

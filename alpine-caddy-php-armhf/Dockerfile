FROM yobasystems/alpine:3.9.0-armhf
LABEL maintainer "Dominic Taylor <dominic@yobasystems.co.uk>" architecture="ARM32v7/armhf"
LABEL alpine-version="3.9.0" caddy-version="0.11.2" build="05-Feb-2019"

ARG plugins=http.git,http.cache,http.expires,http.minify,http.realip

RUN apk add --no-cache openssh-client git libcap tar php7 php7-fpm curl \
    php7-curl php7-gd php7-zip php7-iconv php7-sqlite3 php7-mysqli php7-pgsql php7-json php7-phar php7-openssl php7-zlib

RUN curl --silent --show-error --fail --location \
      --header "Accept: application/tar+gzip, application/x-gzip, application/octet-stream" \
      "https://getcomposer.org/installer" \
    | php -- --install-dir=/usr/bin --filename=composer

RUN echo "clear_env = no" >> /etc/php7/php-fpm.conf

RUN curl --silent --show-error --fail --location --header "Accept: application/tar+gzip, application/x-gzip, application/octet-stream" -o - \
      "https://caddyserver.com/download/linux/arm7?plugins=${plugins}&license=personal&telemetry=off" \
    | tar --no-same-owner -C /usr/bin/ -xz caddy \
 && chmod 0755 /usr/bin/caddy \
 && addgroup -S caddy \
 && adduser -D -S -s /sbin/nologin -G caddy caddy \
 && setcap cap_net_bind_service=+ep `readlink -f /usr/bin/caddy` \
 && /usr/bin/caddy -version

EXPOSE 80 443 2015
WORKDIR /srv

COPY files/Caddyfile /etc/Caddyfile
COPY files/index.php /srv/index.php

RUN chown -R caddy:caddy /srv /var/log

USER caddy

ENTRYPOINT ["/usr/bin/caddy"]
CMD ["--conf", "/etc/Caddyfile"]

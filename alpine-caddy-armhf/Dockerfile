FROM yobasystems/alpine:3.14.0-armhf

ARG BUILD_DATE
ARG VCS_REF

LABEL maintainer="Dominic Taylor <dominic@yobasystems.co.uk>" \
    architecture="arm32v7/armhf" \
    caddy-version="2.4.3" \
    alpine-version="3.14.0" \
    build="07-Jul-2021" \
    org.opencontainers.image.title="alpine-caddy" \
    org.opencontainers.image.description="Caddy Docker image running on Alpine Linux" \
    org.opencontainers.image.authors="Dominic Taylor <dominic@yobasystems.co.uk>" \
    org.opencontainers.image.vendor="Yoba Systems" \
    org.opencontainers.image.version="v2.4.3" \
    org.opencontainers.image.url="https://hub.docker.com/r/yobasystems/alpine-caddy/" \
    org.opencontainers.image.source="https://github.com/yobasystems/alpine-caddy" \
    org.opencontainers.image.revision=$VCS_REF \
    org.opencontainers.image.created=$BUILD_DATE

RUN apk add --no-cache openssh-client git tar curl libcap ca-certificates mailcap

RUN curl --silent --show-error --fail --location --header "Accept: application/tar+gzip, application/x-gzip, application/octet-stream" -o - \
      "https://github.com/caddyserver/caddy/releases/download/v2.4.3/caddy_2.4.3_linux_armv7.tar.gz" \
    | tar --no-same-owner -C /usr/bin/ -xz caddy && \
    chmod 0755 /usr/bin/caddy && \
    addgroup -S caddy && \
    adduser -D -S -s /sbin/nologin -G caddy caddy && \
    setcap cap_net_bind_service=+ep `readlink -f /usr/bin/caddy` && \
    /usr/bin/caddy version

RUN [ ! -e /etc/nsswitch.conf ] && echo 'hosts: files dns' > /etc/nsswitch.conf

VOLUME /config
VOLUME /srv

COPY files/Caddyfile /etc/Caddyfile
COPY files/index.html /srv/index.html

RUN chown -R caddy:caddy /srv

USER caddy

EXPOSE 80 443 2015

WORKDIR /srv

CMD ["caddy", "run", "--config", "/etc/caddy/Caddyfile", "--adapter", "caddyfile"]

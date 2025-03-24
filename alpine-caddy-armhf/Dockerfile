FROM yobasystems/alpine:3.21.3-armhf

ARG BUILD_DATE
ARG VCS_REF

LABEL maintainer="Dominic Taylor <dominic@yoba.systems>" \
    architecture="arm32v7/armhf" \
    caddy-version="2.9.1" \
    alpine-version="3.21.3" \
    build="24-Mar-2025" \
    org.opencontainers.image.title="alpine-caddy" \
    org.opencontainers.image.description="Caddy container image running on Alpine Linux" \
    org.opencontainers.image.authors="Dominic Taylor <dominic@yoba.systems>" \
    org.opencontainers.image.vendor="Yoba Systems" \
    org.opencontainers.image.version="2.9.1" \
    org.opencontainers.image.url="https://hub.docker.com/r/yobasystems/alpine-caddy/" \
    org.opencontainers.image.source="https://github.com/yobasystems/alpine-caddy" \
    org.opencontainers.image.base.name="docker.io/yobasystems/alpine:3.21.3" \
    org.opencontainers.image.revision=$VCS_REF \
    org.opencontainers.image.created=$BUILD_DATE

RUN apk add --no-cache openssh-client git tar curl libcap ca-certificates mailcap

RUN curl --silent --show-error --fail --location --header "Accept: application/tar+gzip, application/x-gzip, application/octet-stream" -o - \
      "https://github.com/caddyserver/caddy/releases/download/v2.9.1/caddy_2.9.1_linux_armv7.tar.gz" \
    | tar --no-same-owner -C /usr/bin/ -xz caddy && \
    chmod 0755 /usr/bin/caddy && \
    addgroup -S caddy && \
    adduser -D -S -s /sbin/nologin -G caddy caddy && \
    setcap cap_net_bind_service=+ep `readlink -f /usr/bin/caddy` && \
    /usr/bin/caddy version

RUN echo 'hosts: files dns' > /etc/nsswitch.conf

VOLUME /config
VOLUME /srv

COPY files/Caddyfile /etc/Caddyfile
COPY files/index.html /srv/index.html

RUN chown -R caddy:caddy /srv

USER caddy

EXPOSE 80 443 2015

WORKDIR /srv

CMD ["caddy", "run", "--config", "/etc/caddy/Caddyfile", "--adapter", "caddyfile"]

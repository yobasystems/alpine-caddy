# Caddy Web Server running on Alpine Linux

[![Docker Stars](https://img.shields.io/docker/stars/yobasystems/alpine-caddy.svg)](https://imagelayers.io/?images=yobasystems/alpine-caddy:latest)

[![Docker Pulls](https://img.shields.io/docker/pulls/yobasystems/alpine-caddy.svg)](https://imagelayers.io/?images=yobasystems/alpine-caddy:latest)

[![Image Size](https://img.shields.io/imagelayers/image-size/yobasystems/alpine-caddy/latest.svg)](https://imagelayers.io/?images=yobasystems/alpine-caddy:latest)

[![Image Layers](https://img.shields.io/imagelayers/layers/yobasystems/alpine-caddy/latest.svg)](https://imagelayers.io/?images=yobasystems/alpine-caddy:latest)


[This](https://hub.docker.com/r/yobasystems/alpine-caddy/) Docker image is based on the minimal [Alpine Linux edge](http://alpinelinux.org/) using the Caddy 0.8.2 HTTP/2 web server with  HTTPS. [Caddy](https://caddyserver.com/).

## Features

  * Minimal size: ??Mb uncompressed, and only ?? layers.
  * Memory usage is minimal on a simple install.
  * Caddy version 0.8.2


## Creating an instance


## Getting Started

```sh
$ docker run -d --name examplecaddy -p 2015:2015 yobasystems/alpine-caddy
```

Point your browser to `http://host-ip:2015`.


## Environment Variables:

### Main Caddy parameters:
* `URL`: specify the url with http:// or https://


### PHP
`:[<version>-]php` variant of this image bundles PHP-FPM. e.g. `:php`, `:0.8.0-php`
```sh
$ docker run -d --name examplecaddy -p 2015:2015 yobasystems/alpine-caddy:php
```
Point your browser to `http://host-ip:2015` and you will see a php info page.

##### Local php source

Replace `/path/to/php/src` with your php sources directory.
```sh
$ docker run -d --name examplecaddy -v /path/to/php/src:/srv -p 2015:2015 yobasystems/alpine-caddy:php
```
Point your browser to `http://host-ip:2015`.

##### Note
Your `Caddyfile` must include the line `startup php-fpm`. For Caddy to be PID 1 in the container, php-fpm could not be started.

### Using git sources

Caddy can serve sites from git repository using [git](https://caddyserver.com/docs/git) middleware.

##### Create Caddyfile

Replace `github.com/team/repo` with your repository.

```sh
$ printf "0.0.0.0\ngit github.com/team/repo" > Caddyfile
```

##### Run the image

```sh
$ docker run -d --name examplecaddy -v $(pwd)/Caddyfile:/etc/Caddyfile -p 2015:2015 yobasystems/alpine-caddy
```
Point your browser to `http://host-ip:2015`.

## Usage

#### Default Caddyfile

The image contains a default Caddyfile.

```
0.0.0.0
browse
fastcgi / 127.0.0.1:9000 php # php variant only
startup php-fpm # php variant only
```
**Note** the last 2 lines are only present in the php variant.

#### Paths in container

Caddyfile: `/etc/Caddyfile`

Sites root: `/srv`

#### Using local Caddyfile and sites root

Replace `/path/to/Caddyfile` and `/path/to/sites/root` accordingly.

```sh
$ docker run -d --name examplecaddy -v /path/to/sites/root:/srv -v path/to/Caddyfile:/etc/Caddyfile -p 2015:2015 yobasystems/alpine-caddy
```

### Let's Encrypt Auto SSL
**Note** that this does not work on local environments, the domain also has to resolve to the server requesting the certificate.

Use a valid domain and add email to your Caddyfile to avoid prompt at runtime.
Replace `example.co.uk` with your domain and `user@example.co.uk` with your email.
```
example.co.uk
tls user@example.co.uk
```

##### Run the image

You can change the the ports if ports 80 and 443 are not available on host. e.g. 81:80, 444:443

```sh
$ docker run -d --name examplecaddy -v $(pwd)/Caddyfile:/etc/Caddyfile -p 80:80 -p 443:443 yobasystems/alpine-caddy
```

**Optional** but advised. Save certificates on host machine to prevent regeneration every time container starts.
Let's Encrypts [RATE LIMITS](https://community.letsencrypt.org/t/rate-limits-for-lets-encrypt/6769) explain the number of times you can regenerate certificates.

```sh
$ docker run -d -v $(pwd)/Caddyfile:/etc/Caddyfile -v $HOME/.caddy:/root/.caddy -p 80:80 -p 443:443 yobasystems/alpine-caddy
```

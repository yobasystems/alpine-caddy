# Caddy Docker image running on Alpine Linux

[![Docker Layers](https://img.shields.io/badge/docker%20layers-5-blue.svg?maxAge=2592000?style=flat-square)](https://hub.docker.com/r/yobasystems/alpine-caddy/) [![Docker Size](https://img.shields.io/badge/docker%20size-17.1%20MB-blue.svg?maxAge=2592000?style=flat-square)](https://hub.docker.com/r/yobasystems/alpine-caddy/) [![Docker Stars](https://img.shields.io/docker/stars/yobasystems/alpine-caddy.svg?maxAge=2592000?style=flat-square)](https://hub.docker.com/r/yobasystems/alpine-caddy/) [![Docker Pulls](https://img.shields.io/docker/pulls/yobasystems/alpine-caddy.svg?maxAge=2592000?style=flat-square)](https://hub.docker.com/r/yobasystems/alpine-caddy/)

[![Alpine Version](https://img.shields.io/badge/alpine%20version-v3.5-green.svg?maxAge=2592000?style=flat-square)](http://alpinelinux.org/) [![Caddy Version](https://img.shields.io/badge/caddy%20version-v0.9.5-green.svg?maxAge=2592000?style=flat-square)](https://caddyserver.com/)



This Docker image [(yobasystems/alpine-caddy)](https://hub.docker.com/r/yobasystems/alpine-caddy/) is based on the minimal [Alpine Linux](http://alpinelinux.org/)  using the [Caddy](https://caddyserver.com/) 0.9.5 HTTP/2 web server with HTTPS.

## Features

  * Minimal size only 17.1 MB and only 5 layers
  * Memory usage is minimal on a simple install
  * Caddy version 0.9.5
  * Memory usage is very small on a simple install
  * Armv7 (armhf) version with ```:armhf``` tag
  * Armv7 (armhf) version with php ```:armhf-php``` tag

## Tags

* ```:latest``` latest nginx & alpine
* ```:master``` master branch usually inline with latest
* ```:php``` latest branch with git which auto pulls repo upon container start
* ```:v0.0.0``` version number related to nginx version
* ```:armhf``` Armv7 based on latest tag but arm architecture
* ```:armhf-php``` Armv7 based on latest tag but arm architecture and includes PHP

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

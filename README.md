# Caddy Docker image running on Alpine Linux

[![Docker Layers](https://img.shields.io/badge/docker%20layers-5-blue.svg?maxAge=2592000?style=flat-square)](https://hub.docker.com/r/yobasystems/alpine-caddy/) [![Docker Size](https://img.shields.io/badge/docker%20size-17.1%20MB-blue.svg?maxAge=2592000?style=flat-square)](https://hub.docker.com/r/yobasystems/alpine-caddy/) [![Docker Stars](https://img.shields.io/docker/stars/yobasystems/alpine-caddy.svg?maxAge=2592000?style=flat-square)](https://hub.docker.com/r/yobasystems/alpine-caddy/) [![Docker Pulls](https://img.shields.io/docker/pulls/yobasystems/alpine-caddy.svg?maxAge=2592000?style=flat-square)](https://hub.docker.com/r/yobasystems/alpine-caddy/)

[![Alpine Version](https://img.shields.io/badge/alpine%20version-v3.5-green.svg?maxAge=2592000?style=flat-square)](http://alpinelinux.org/) [![Caddy Version](https://img.shields.io/badge/caddy%20version-v0.10.3-green.svg?maxAge=2592000?style=flat-square)](https://caddyserver.com/)



This Docker image [(yobasystems/alpine-caddy)](https://hub.docker.com/r/yobasystems/alpine-caddy/) is based on the minimal [Alpine Linux](http://alpinelinux.org/)  using the [Caddy](https://caddyserver.com/) HTTP/2 web server with HTTPS.

##### Alpine Version 3.6.2 (Released Jun 17, 2017)
##### Caddy Version 0.10.3

----

## What is Alpine Linux?
Alpine Linux is a Linux distribution built around musl libc and BusyBox. The image is only 5 MB in size and has access to a package repository that is much more complete than other BusyBox based images. This makes Alpine Linux a great image base for utilities and even production applications. Read more about Alpine Linux here and you can see how their mantra fits in right at home with Docker images.

## What is Caddy?

## Features

  * Minimal size only 20 MB and only 5 layers
  * Memory usage is minimal on a simple install
  * Auto HTTPS

## Architectures

* ```:amd64```, ```:latest``` - 64 bit Intel/AMD (x86_64/amd64)
* ```:i386```, ```:x86``` - 32 bit Intel/AMD (x86/i686)
* ```:arm64v8```, ```:aarch64``` - 64 bit ARM (ARMv8/aarch64)
* ```:arm32v7```, ```:armhf``` - 32 bit ARM (ARMv7/armhf)

#### PLEASE CHECK TAGS BELOW FOR SUPPORTED ARCHITECTURES, THE ABOVE IS A LIST OF EXPLANATION

## Tags

* ```:latest```, ```:amd64``` latest branch based on amd64
* ```:master``` master branch usually inline with latest
* ```:php``` latest branch with php
* ```:v0.0.0``` version number related to docker version
* ```:armhf```, ```:arm32v7``` Armv7 based on latest tag but arm architecture
* ```:armhf-php```, ```:arm32v7-php``` Armv7 based on latest tag but arm architecture and includes php


## Environment Variables:

### Main Caddy parameters:
* `URL`: specify the url with http:// or https://

## Creating an instance

```sh
$ docker run -d --name examplecaddy -p 2015:2015 yobasystems/alpine-caddy
```

Point your browser to `http://host-ip:2015`.

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

## Source Repository

* [Bitbucket - yobasystems/alpine-caddy](https://bitbucket.org/yobasystems/alpine-caddy/)

* [Github - yobasystems/alpine-caddy](https://github.com/yobasystems/alpine-caddy)

## Links

* [Yoba Systems](https://www.yobasystems.co.uk/)

* [Dockerhub - yobasystems](https://hub.docker.com/u/yobasystems/)

* [Quay.io - yobasystems](https://quay.io/organization/yobasystems)

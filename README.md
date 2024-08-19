# Caddy container image running on Alpine Linux

[![Docker Automated build](https://img.shields.io/docker/automated/yobasystems/alpine-caddy.svg?style=for-the-badge&logo=docker)](https://hub.docker.com/r/yobasystems/alpine-caddy/)
[![Docker Pulls](https://img.shields.io/docker/pulls/yobasystems/alpine-caddy.svg?style=for-the-badge&logo=docker)](https://hub.docker.com/r/yobasystems/alpine-caddy/)
[![Docker Stars](https://img.shields.io/docker/stars/yobasystems/alpine-caddy.svg?style=for-the-badge&logo=docker)](https://hub.docker.com/r/yobasystems/alpine-caddy/)

[![Alpine Version](https://img.shields.io/badge/Alpine%20version-v3.19.3-green.svg?style=for-the-badge)](https://alpinelinux.org/)
[![Caddy Version](https://img.shields.io/badge/Caddy%20version-v2.8.1-green.svg?style=for-the-badge)](https://caddyserver.com/)


This container image [(yobasystems/alpine-caddy)](https://hub.docker.com/r/yobasystems/alpine-caddy/) is based on the minimal [Alpine Linux](https://alpinelinux.org/)  using the [Caddy](https://caddyserver.com/) HTTP/2 web server with HTTPS.

### Alpine Version 3.19.3 (Released 2024-07-22)
##### Caddy Version 2.8.1

----

## Table of Contents

- [What is Alpine Linux?](#what-is-alpine-linux)
- [Features](#features)
- [Architectures](#architectures)
- [Tags](#tags)
- [Layers & Sizes](#layers--sizes)
- [How to use this image](#how-to-use-this-image)
- [Image contents & Vulnerability analysis](#image-contents--vulnerability-analysis)
- [Source Repositories](#source-repositories)
- [Container Registries](#container-registries)
- [Links](#links)
- [Donation](#donation)


## 🏔️ What is Alpine Linux?
Alpine Linux is a Linux distribution built around musl libc and BusyBox. The image is only 5 MB in size and has access to a package repository that is much more complete than other BusyBox based images. This makes Alpine Linux a great image base for utilities and even production applications. Read more about Alpine Linux here and you can see how their mantra fits in right at home with Container images.

## What is Caddy?
Caddy, sometimes clarified as the Caddy web server, is an open source, HTTP/2-enabled web server written in Go. It uses the Go standard library for its HTTP functionality. One of Caddy's most notable features is enabling HTTPS by default.

## ✨ Features

* Minimal size only, minimal layers
* Memory usage is minimal on a simple install.
* Auto git clone from repo with `yobasystems/alpine-nginx:git` tag

## 🏗️ Architectures

* ```:amd64```, ```:x86_64``` - 64 bit Intel/AMD (x86_64/amd64)
* ```:arm64v8```, ```:aarch64``` - 64 bit ARM (ARMv8/aarch64)
* ```:arm32v7```, ```:armhf``` - 32 bit ARM (ARMv7/armhf)

#### 📝 PLEASE CHECK TAGS BELOW FOR SUPPORTED ARCHITECTURES, THE ABOVE IS A LIST OF EXPLANATION

## 🏷️ Tags

* ```:latest``` latest branch based (Automatic Architecture Selection)
* ```:php``` latest branch with php
* ```:amd64```, ```:x86_64```  amd64 based on latest tag but amd64 architecture
* ```:php-amd64```, ```:php-x86_64```  amd64 based on latest tag but amd64 architecture and includes php
* ```:aarch64```, ```:arm64v8``` Armv8 based on latest tag but arm64 architecture
* ```:php-aarch64```, ```:php-arm64v8``` Armv8 based on latest tag but arm64 architecture and includes php
* ```:armhf```, ```:arm32v7``` Armv7 based on latest tag but arm architecture
* ```:php-armhf```, ```:php-arm32v7``` Armv7 based on latest tag but arm architecture and includes php

## 📏 Layers & Sizes

![Version](https://img.shields.io/badge/version-amd64-blue.svg?style=for-the-badge)
![MicroBadger Layers (tag)](https://img.shields.io/docker/layers/yobasystems/alpine-caddy/amd64.svg?style=for-the-badge)
![MicroBadger Size (tag)](https://img.shields.io/docker/image-size/yobasystems/alpine-caddy/amd64.svg?style=for-the-badge)

![Version](https://img.shields.io/badge/version-aarch64-blue.svg?style=for-the-badge)
![MicroBadger Layers (tag)](https://img.shields.io/docker/layers/yobasystems/alpine-caddy/aarch64.svg?style=for-the-badge)
![MicroBadger Size (tag)](https://img.shields.io/docker/image-size/yobasystems/alpine-caddy/aarch64.svg?style=for-the-badge)

![Version](https://img.shields.io/badge/version-armhf-blue.svg?style=for-the-badge)
![MicroBadger Layers (tag)](https://img.shields.io/docker/layers/yobasystems/alpine-caddy/armhf.svg?style=for-the-badge)
![MicroBadger Size (tag)](https://img.shields.io/docker/image-size/yobasystems/alpine-caddy/armhf.svg?style=for-the-badge)

## 🚀 How to use this image
## Environment Variables:

### Main Caddy parameters:
* `URL`: specify the url with http:// or https://

## Creating an instance

```sh
$ docker run -d --name examplecaddy -p 2015:2015 yobasystems/alpine-caddy
```

Point your browser to `http://host-ip:2015`.

### PHP
`:[<version>-]php` variant of this image bundles PHP-FPM. e.g. `:php`, `:0.11.0-php`
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

## 🔍 Image contents & Vulnerability analysis

| PACKAGE NAME          | PACKAGE VERSION | VULNERABILITIES |
|-----------------------|-----------------|-----------------|


## 📚 Source Repositories

* [Github - yobasystems/alpine-caddy](https://github.com/yobasystems/alpine-caddy)

* [Gitlab - yobasystems/alpine-caddy](https://gitlab.com/yobasystems/alpine-caddy)

* [Bitbucket - yobasystems/alpine-caddy](https://bitbucket.org/yobasystems/alpine-caddy/)


## 🐳 Container Registries

* [Dockerhub - yobasystems/alpine-caddy](https://hub.docker.com/r/yobasystems/alpine-caddy/)

* [Quay.io - yobasystems/alpine-caddy](https://quay.io/repository/yobasystems/alpine-caddy)


## 🔗 Links

* [Yoba Systems](https://www.yobasystems.co.uk/)

* [Github - Yoba Systems](https://github.com/yobasystems/)

* [Dockerhub - Yoba Systems](https://hub.docker.com/u/yobasystems/)

* [Quay.io - Yoba Systems](https://quay.io/organization/yobasystems)

* [Maintainer - Dominic Taylor](https://github.com/dominictayloruk)

## 💰 Donation

[![BMAC](https://img.shields.io/badge/BUY%20ME%20A%20COFFEE-£5-blue.svg?style=for-the-badge&logo=buy-me-a-coffee)](https://www.buymeacoffee.com/dominictayloruk?new=1)

[![BITCOIN](https://img.shields.io/badge/BTC-bc1q7hy8qmyvq7rw6slrna7yffcdnj9rcg4e9xjecc-blue.svg?style=for-the-badge&logo=bitcoin)](bitcoin:bc1q7hy8qmyvq7rw6slrna7yffcdnj9rcg4e9xjecc)

[![ETHEREUM](https://img.shields.io/badge/ETH-0xb6bE2e4da3d86b50Bdae1F9B6960c23dd87C532C-blue.svg?style=for-the-badge&logo=ethereum)](ethereum:0xb6bE2e4da3d86b50Bdae1F9B6960c23dd87C532C)

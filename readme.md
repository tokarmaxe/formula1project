# Installation

*Please download & install latest versions from:*

```
https://store.docker.com/search?offering=community&type=edition
https://docs.docker.com/compose/install/
```

*Add to a hosts file on your local machine:*

```
127.0.0.1 api.baraholka.local
```

*Run:* 
```
cd docker
docker-compose up -d --build
```

*Workspace:*

You are able to run commands and work in a php-fpm container. 
It allows you to run any needed command without ssh into it

First of all:

```
docker-compose exec php-fpm composer install
```

Examples:

```
docker-compose exec php-fpm php artisan migrate
docker-compose exec php-fpm php artisan db:seed
docker-compose exec php-fpm {service} {args}
```

*The site should be available by next address*
```
http://api.vptech.local Port:8080

```
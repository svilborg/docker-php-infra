# docker-php-infra
PHP Docker Infrastructure

Available services :

- php-fpm
- php-cli
- apache2
- nginx
- mysql
- postgres
- dynamodb
- elasticsearch
- mongo
- redis

##### Running tests

```
 docker-compose up
```

```
 docker-compose run --rm php-cli php ./test/index.php
```
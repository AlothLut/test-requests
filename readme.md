## Tested on Ubuntu 20.1

## Dependencies:
- Docker
- Docker-compose

## To check, follow these steps:
1) run ```docker-compose up -d --build```

2) install dependencies ```docker-compose exec -T php-test bash -c "composer install"```

3) check examples for microservice request http://0.0.0.0/settings/first-microservice and http://0.0.0.0/settings-set/first-microservice


CONTAINER_NAME = php

up:
	docker-compose --env-file .env up -d


stop:
	docker-compose stop

down:
	docker-compose down

shell:
	docker exec -it $(CONTAINER_NAME) bash

copy-env:
	 cp .env.example .env

composer-install:
	docker exec -it $(CONTAINER_NAME) composer install

configure-app-key:
	docker exec -it $(CONTAINER_NAME) php artisan key:generate

migrate:
	docker exec -it $(CONTAINER_NAME) php artisan migrate

seed:
	docker exec -it $(CONTAINER_NAME) php artisan db:seed

test:
	docker exec -it $(CONTAINER_NAME) php artisan test

clear-shema:
	docker exec -it $(CONTAINER_NAME) php artisan migrate:refresh --seed

setup-app:
	make up 
	make composer-install
	make configure-app-key
	clear-shema
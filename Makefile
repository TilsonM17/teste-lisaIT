# Define o nome do contêiner que você deseja acessar
CONTAINER_NAME = php

# Inicia os Containers
up:
	docker-compose --env-file .env up -d

# Parar os containers
stop:
	docker-compose stop

# Parar os containers e remover os containers
down:
	docker-compose down

shell:
	docker exec -it $(CONTAINER_NAME) bash

# Copia o arquivo .env do seu sistema de arquivos local para o contêiner
copy-env:
	 cp .env.example .env

# Executa o comando composer install no contêiner
composer-install:
	docker exec -it $(CONTAINER_NAME) composer install

# Configura a chave do aplicativo Laravel no contêiner
configure-app-key:
	docker exec -it $(CONTAINER_NAME) php artisan key:generate

migrate:
	docker exec -it $(CONTAINER_NAME) php artisan migrate

seed:
	docker exec -it $(CONTAINER_NAME) php artisan db:seed

test:
	docker exec -it $(CONTAINER_NAME) php artisan test

clear-shema:
	docker exec -it $(CONTAINER_NAME) php artisan migrate:refresh
	make seed

# Comando para realizar todas as tarefas
setup-app:
	make up 
	make composer-install
	make configure-app-key
	clear-shema
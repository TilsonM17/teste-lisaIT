## Descrição do projeto

O objetivo é criar uma api de um TODO LIST que permita o usuário criar uma tarefas, adicionar, remover, e atualizar.

## Como rodar o projeto

Usei o docker para facilitar na unificação de ambiente. Caso não deseje usar o docker sinta-se avontade para seguir de maneira normal.

Faça um clone do projeto e entre na pasta do projeto e siga os passos a seguir.

Os Passos abaixo descrevem usando o docker

1 . Copie o conteudo do arquivo .env.example para o .env

```bash
cp .env.example .env
```

2 . Rode o comando para subir os containers do docker.

```bash
docker-compose --env-file .env up -d
```

3 . Acesse o container da aplicação e instale as dependencias.

```bash
docker exec -it php_lisa_it composer install
```

4 . Gerar a chave do projeto

```bash
docker exec -it php_lisa_it php artisan key:generate
```

5 . Rode o comando para criar as tabelas no banco de dados

```bash
docker exec -it php_lisa_it  php artisan migrate --seed
```

---

Isso vai criar um usuario de teste que pode usar para se autenticar:

 email: **<admin@admin.com>**

 senha: **abc123**

## Endpoints

[**Collection no Postman**](https://www.postman.com/tilsonm17/workspace/lisait/collection/18846329-57930c12-e26f-4a00-8f3a-afea8f37a84f?action=share&creator=18846329)

## Testes

```bash
docker exec -it php_lisa_it php artisan test
```

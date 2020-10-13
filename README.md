# RESTful API with Symfony 4 & Docker deployment
This API contains some endpoints to manage users and a small login to test 

## Requirements
- *composer*
- *database engine*
- *php (we  do it with an internal server too)*
- *docker & docker-compose (in case of using docker)*
## Install without Docker

- *create your own .env file with your config*
-  **launch following commands:**
-- *composer install*
-- *php bin/console doctrine:database:create*
-- *php bin/console doctrine:migrations:migrate*
--*php bin/console doctrine:fixtures:load*

## Install with Docker
- *select docker branch and download it*
- *create your own .env file with your config in /apps/hola/*
-  **launch following commands:**
-- *docker-compose up –d*
-- *docker exec -it "your_php_container_name" php bin/console doctrine:database:create*
-- *docker exec -it "your_php_container_name" php bin/console doctrine:migrations:migrate*
-- *docker exec -it "your_php_container_name" php bin/console doctrine:fixtures:load*

### *Build in server
Symfony provides a web server built on top of this PHP server to simplify your local setup.
With this command mounts the server: **symfony server:start -d** and there is ready to use. 

## Public endpoints
#### Get users

Get all `users`. 

**`GET` `/api/users`**

Response:

```json
{
    "action": "Get Users",
    "status": 200,
    "data": [
        {
            "id": 1,
            "name": "Admin",
            "username": "admin",
            "password": "$argon2id$v=19$m=65536,t=4,p=1$STZXUXZhcWlNVElNdEYveQ$g1/hd5A7fzNBj/KtbM9jDiCzXSmrAmrRtl6OpjFJIuI",
            "roles": [
                "ROLE_ADMIN",
                "ROLE_USER"
            ],
            "salt": null
        }
    ]
}
```

#### Get user by id

Get a specific `user` by `id`.

**`GET` `/api/user/id`**

Response:

```json
{
    Very similar... 
}
```

## Private endpoints
Need to be logged to do this actions
#### Create user
Create a `user`. 

**`POST` `/api/user`**

Query Params:

- **`name `**: Not null.
- **`username `**: Not null.
- **`password `**: Not null.
- **`roles `**: Not null. Must be an array.
- 
Response:
```json
{
    "action": "New Users",
    "status": 200,
    "data": {
        "id": 12,
        "name": "lorem",
        "username": "ipsum",
        "password": "$argon2id$v=19$m=65536,t=4,p=1$MkVteDUubk1NVWVlRW1BOA$mUvwngAJZO++dpoAkOj3hSqsFBQNcDSDLRgfA2UMAf4",
        "roles": [
            "ROLE_LOREM",
            "ROLE_USER"
        ],
        "salt": null
    }
}
```

#### Update user

Update a `user`. 

**`PUT` `/api/user/id`**
Query Params:

- **`name `**: Not null.
- **`username `**: Not null.
- **`password `**: Not null.
- **`roles `**: Not null. Must be an array.

Response:
```json
{
    Very similar... 
}
```

#### Delete user

Delete a `user`. 

**`DELETE` `/api/user/id`**

Response:
```json
{
    Very similar... 
}
```

## Public URLs
#### Login

Go to `login` page. 

**`/login`**

### Private
Need to be logged to do this actions
#### -Custom

After login correctly we are redirected to `custom` page. 

**`/custom`**
#### -Page 1

Only can visit this url users with `ROLE_ADMIN` or `ROLE_PAGE_1` roles. 

**`/page/1`**
#### -Page 2

Only can visit this url users with `ROLE_ADMIN` or `ROLE_PAGE_2` roles. 

**`/page/2`**

```js
//TODO: improve api login system
```
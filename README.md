# RESTful API with Symfony 4 & Docker deployment
This API contains some endpoints to manage users and a small login to test 

## Requirements
- *composer*
- *database engine*
- *php (we  do it with an internal server too)*
- *docker & docker-compose (in case of using docker)*
## Install without Docker

- *create your own .env file with your config (database url, JWT passphrase...)*
-  **launch following commands:**
- *composer install*
- *php bin/console doctrine:database:create*
- *php bin/console doctrine:migrations:migrate*
- *php bin/console doctrine:fixtures:load*

#### Generate the SSH keys:

``` bash
$ mkdir -p config/jwt
$ openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096 (insert your JWT passphrase from your .env file)
$ openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout (insert your JWT passphrase from your .env file)
Check the permission of created files to avoid headaches
```

## Install with Docker
- *select docker branch and download it*
- *create your own .env file with your config (database url, JWT passphrase...) in /apps/hola/*
-  **launch following commands:**
- *docker-compose up –d*
- *docker exec -it "your_php_container_name" php bin/console doctrine:database:create*
- *docker exec -it "your_php_container_name" php bin/console doctrine:migrations:migrate*
- *docker exec -it "your_php_container_name" php bin/console doctrine:fixtures:load*

#### Generate the SSH keys with docker:

``` bash
$ docker exec -it "your_php_container_name"  mkdir -p config/jwt
$ docker exec -it "your_php_container_name" openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096 (insert your JWT passphrase from your .env file)
$ docker exec -it "your_php_container_name" openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout (insert your JWT passphrase from your .env file)
Check the permission of created files to avoid headaches
```

### *Build in server
Symfony provides a web server built on top of this PHP server to simplify your local setup.
With this command mounts the server: **symfony server:start -d** and there is ready to use. 
Usage



### 1. Get a token

The first step is to authenticate the user using its credentials.

You can test getting the token with a simple curl command like this (adapt host and port):
```bash
curl -X POST -H "Content-Type: application/json" http://localhost/api/login_check -d '{"username":"johndoe","password":"test"}'
```

If it works, you will receive something like this:

```json
{
   "token" : "eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXUyJ9.eyJleHAiOjE0MzQ3Mjc1MzYsInVzZXJuYW1lIjoia29ybGVvbiIsImlhdCI6IjE0MzQ2NDExMzYifQ.nh0L_wuJy6ZKIQWh6OrW5hdLkviTs1_bau2GqYdDCB0Yqy_RplkFghsuqMpsFls8zKEErdX5TYCOR7muX0aQvQxGQ4mpBkvMDhJ4-pE4ct2obeMTr_s4X8nC00rBYPofrOONUOR4utbzvbd4d2xT_tj4TdR_0tsr91Y7VskCRFnoXAnNT-qQb7ci7HIBTbutb9zVStOFejrb4aLbr7Fl4byeIEYgp2Gd7gY"
}
```

Store it (client side), the JWT is reusable until its ttl has expired (3600 seconds by default).

### 2. Use the token

Simply pass the JWT on each request to the protected firewall, either as an authorization header
or as a query parameter. 

By default only the authorization header mode is enabled : `Authorization: Bearer {token}`

## Public endpoints
#### Get users

Get all `users`. 

**`GET` `/users`**

Response:

```json
{
    "results": {
        "id": 00,
        "name": "test",
        "username": "test",
        "password": "$argon2id$v=19$m=65536,t=4,p=1$dG5yQ1AuUFloTWxIT2VxUQ$3z4Uw2n04az/jx3utOW8XCvWzR3rp6kjK9PekjEdQSk",
        "roles": [
            "ROLE_USER"
        ],
        "salt": null
    }
}
```

#### Get user by id

Get a specific `user` by `id`.

**`GET` `/user/id`**

Response:

```json
{
    Very similar... 
}
```

## Private endpoints

Need a token to do this actions

#### Create user

Create a `user`. 

**`POST` `/api/user`**

Query Params:

- **`name `**: Not null.
- **`username `**: Not null and unique.
- **`password `**: Not null.
- **`roles `**: Not null. Must be an array.
- 
Response:
```json
{
    "results": {
        "id": 00,
        "name": "test",
        "username": "test",
        "password": "$argon2id$v=19$m=65536,t=4,p=1$dG5yQ1AuUFloTWxIT2VxUQ$3z4Uw2n04az/jx3utOW8XCvWzR3rp6kjK9PekjEdQSk",
        "roles": [
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
- **`username `**: Not null and unique.
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
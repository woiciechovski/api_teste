# ![Laravel CRUD App]

# Getting started

## Installation


Clone the repository

    git clone https://github.com/woiciechovski/api_teste

Switch to the repo folder

    cd api_teste

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Create the database sqlite file

    cp database/database.sqlite.example database/database.sqlite

Run the database migrations

    php artisan migrate


Run laravel passport install

    php artisan passport:install

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

----------

## Routes that return the access token

Register in the aplication:

    /api/v1/register

        Method: POST
        Body: {
            "name": Required,
            "email" Required,
            "password" Required,
            "phone" Required
            }
        Response: {
            "access_token": "string",
        }

log in:

    /oauth/token

        Method: POST
        Body: {
            "grant_type": "password",
            "client_id": 2,
            "client_secret": client_secret (**switch to the generated client_secret**),
            "email" Required,
            "password" Required
            }
        Response: {
            "access_token": "string",
        }

# User Routes:

List all users:

    /api/v1/users

        Method: GET
        Header: {
            Accept: application/json,
            Authorization: Bearer {access_token}
            }
        Response: {
            "id": 1,
            "name": "string",
            "email": "string",
            "phone": "string",
            "created_at": "2020-05-05 12:12:12",
            "updated_at": "2020-05-05 12:12:12"
        }

Register one user:


    /api/v1/users

        Method: POST
        Header: {
            Accept: application/json,
            Authorization: Bearer {access_token}
            }
        Body: {
            "name": Required,
            "email" Required,
            "password" Required,
            "phone" Required,
            "photo" Not required
            }
        Response: {
            "id": 1,
            "name": "string",
            "email": "string",
            "phone": "string",
            "photo_name": "string",
            "photo_path": "string",
            "created_at": "2020-05-05 12:12:12",
            "updated_at": "2020-05-05 12:12:12"
        }

List one User
    
    
    /api/v1/users/{id}

        Method: GET
        Header: {
            Accept: application/json,
            Authorization: Bearer {access_token}
            }
        Response: {
            "id": 1,
            "name": "string",
            "email": "string",
            "phone": "string",
            "photo_name": "string",
            "photo_path": "string",
            "created_at": "2020-05-05 12:12:12",
            "updated_at": "2020-05-05 12:12:12"
        }

Edit one User

    /api/v1/users/{id}
    
        Method: PUT
        Header: {
            Accept: application/json,
            Authorization: Bearer {access_token}
            }
        Body: {
            "name": Required,
            "email" Required,
            "password" Required,
            "phone" Required,
            "photo" Not required
            }
        Response: {
            "id": 1,
            "name": "string",
            "email": "string",
            "phone": "string",
            "photo_name": "string",
            "photo_path": "string",
            "created_at": "2020-05-05 12:12:12",
            "updated_at": "2020-05-05 12:12:12"
        }

Delete one User

    /api/v1/users/{id}

        Method: DELETE
        Header: {
            Accept: application/json,
            Authorization: Bearer {access_token}
            }
        Response: {
            "id": 1,
            "name": "string",
            "email": "string",
            "phone": "string",
            "photo_name": "string",
            "photo_path": "string",
            "created_at": "2020-05-05 12:12:12",
            "updated_at": "2020-05-05 12:12:12"
        }


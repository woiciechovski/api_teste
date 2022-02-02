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


Run laravel passport installation
this operation will do the database migrations (**Set the database connection in .env before migrating**)

    php artisan passport:install --uuids

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

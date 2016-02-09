# onlinesenpai-api
The backend component to the Dojo-management platform.

The onlinesenpai project aims to simplify examination-process for you and your students alike.
It lets your students know, when their next exam is due and provides them with instructions and videos to the contents of the examination in order to motivate them to practice by themselves.

This project is still under heavy development.

## Setup
Prerequisites:

    PHP 5.5 or newer
    composer
    Database of your choice (mariadb)

Project-Setup:

    cd onlinesenpai-api
    composer install

Database Initialization:

    run SQL-Commands from ./api/app/Resources/Scripts/setup.sql

## Run the application
    cd onlinesenpai-api
    php ./bin/console server:run

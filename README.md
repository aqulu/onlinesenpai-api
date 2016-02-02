# OnlineSenpai-API
The backend component to the Dojo-management platform.

The onlinesenpai projects aims to simplify examination-process of your students.
It lets your students know, when their next exam is due and provides them with instructions and videos to the contents of the examination, in order to motivate them to practice by themselves.

## Setup
Prerequisites:
    PHP 5.5 or newer
    composer
    Database of your choice (mariadb)

Project-Setup:
    cd onlinesenpai-api
    composer install // provide database-connection infos during installation-process
    
Database Initialization:
    run SQL-Commands from ./api/app/Resources/Scripts/setup.sql
    
## Run the application
    cd onlinesenpai-api
    php ./bin/console server:run
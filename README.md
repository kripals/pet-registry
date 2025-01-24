Start off by 
    docker-compose up -d --build
Will build all the containers and needed things in it like composer install and npm install

for the backend 
    - run "php bin/console doctrine:migrations:migrate" to migrate the tables in the database
    - run "php bin/console doctrine:fixtures:load" to seed the tables


Start off by 
    docker-compose up -d --build
Will build all the containers and needed things in it like composer install and npm install
* if the node_modules in the frontend is empty
    - the issue may arise sometime, the quick fix is to run "rm -rf node_modules package-lock.json" and then "npm install" inside the container

for the backend 
    - run "php bin/console doctrine:migrations:migrate" to migrate the tables in the database
    - run "php bin/console doctrine:fixtures:load" to seed the tables


Future changes
    - Registration can be converted register many different types of pet type (.i.e cats, birds, etc)
    - Need to make the age a float, functions are already there to support it
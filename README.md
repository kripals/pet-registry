# Pet Registry

## Getting Started

Start off by running:
```sh
docker-compose up -d --build
```
This will build all the containers and install dependencies like `composer install` and `npm install`.

### Troubleshooting

* If the `node_modules` in the frontend is empty:
    - The issue may arise sometimes. The quick fix is to run:
    ```sh
    rm -rf node_modules package-lock.json
    npm install
    ```
    inside the frontend container.

### Backend Setup

* Copy the `.env.example` file to `.env` to set up your environment variables:
    ```sh
    cp .env.example .env
    ```
* Run the following command to migrate the tables in the database, use the php container:
    ```sh
    php bin/console doctrine:migrations:migrate
    ```
* Run the following command to seed the tables, use the php container:
    ```sh
    php bin/console doctrine:fixtures:load
    ```

### Project Structure

The project structure is as follows:

```
pet-registry/
├── backend/
│   ├── bin/
│   ├── config/
│   ├── public/
│   ├── src/
│   ├── templates/
│   ├── translations/
│   ├── var/
│   ├── vendor/
│   ├── .env
│   ├── composer.json
│   └── symfony.lock
├── frontend/
│   ├── public/
│   ├── src/
│   ├── .env
│   ├── package.json
│   ├── package-lock.json
│   └── webpack.config.js
├── docker-compose.yml
└── README.md
```

## Future Changes

* Registration can be extended to register many different types of pets (e.g., cats, birds, etc.).
* The age field needs to be converted to a float. Functions are already in place to support this.
* The controller test cases can be updated.
* Can add a list page for the registration data.
* Can add CRUD pages for pet_type, owners, breeds. APIs are ready just need the frontend.
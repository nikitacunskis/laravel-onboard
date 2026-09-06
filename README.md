# Laravel onboard

## Project Explanation

This project is build to fast onboard something new. It comprises three main components:

- **Docker:** It allows you to run project in container and set-up it fast anywhere
- **Frontend:** Built with Vue3. There's integration between Vue3.js for front-end and safe connection to backend.
- **Backend:** Built with Laravel. Laravel is designed as API first here.

### Key Features

- **User Authentication:** Includes login and registration systems.
- **Access Control:** Implements views with restrictions to ensure secure access to protected areas.

## Project Installation

Follow the steps below to set up the project:

1. **Docker Setup:**
  - Navigate to the `docker` directory.
  - Run the following command to build and start the containers:
    ```bash
    docker compose up -d --build
    ```

2. **Environment Configuration:**
  - Go to the `app` folder.
  - Copy the example environment file to create a new one:
    ```bash
    cp .env.example .env
    ```
  - Edit the `.env` file to set your database credentials:
    ```
    DB_DATABASE=onboard
    DB_PASSWORD=root
    ```
    *Note:* If you have customized the MySQL credentials in `docker-compose.yml`, update the `.env` file accordingly.

3. **Backend Setup:**
  - Enter the backend container by running:
    ```bash
    docker exec -it backend /bin/bash
    ```
  - Inside the container, execute the following commands:
    ```bash
    composer install
    php artisan key:generate
    php artisan migrate
    php artisan db:seed
     ```
  - In case you get error "Unable to set application key. No APP_KEY variable was found in the .env file.", you need to generate it manually and add to .env file APP_KEY
    ```bash
    php artisan key:generate --show
    ```

4. **Frontend Setup:**
  - Frontend setup should be done automatically. In case it doesn't continue with further steps
  - Exit the backend shell.   
  - Enter the frontend container by running:
    ```bash
    docker exec -it frontend /bin/bash
    ```
  - Run:
    ```bash
    npm i
    ```
  - Run:
    ```bash
    npm run dev -- --host
    ``` 

5. **Accessing the Application:**
  - Once setup is complete, the application should be accessible at:
    - Frontend: [http://localhost](http://localhost)
    - Backend API: [http://localhost/api](http://localhost/api)

## Summary

This project successfully integrates a Vue3 frontend with a Laravel backend, featuring a robust login and registration system along with secure, restricted views.

Happy coding!


---

Built by [Nikita Cunskis](https://cunskis.lv/) — senior engineer and fractional CTO, Riga. More tools: [cunskis.lv/open-source](https://cunskis.lv/open-source).

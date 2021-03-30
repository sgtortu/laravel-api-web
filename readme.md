# Laravel - Economic balance

![version](https://img.shields.io/badge/version-1.0.0-blue.svg)   

## Description
Personal financial balance management.
- Database: mysql
- Api: Laravel
- Web: Laravel


## Technology used

<img src="https://es.wikipedia.org/wiki/Laravel#/media/Archivo:Laravel.svg" width="60" height="60" />



## Clone and run the project

After cloning the repository:

- Create a database and leave it empty.
- Modify the file ".env.example" to ".env"
     - Make necessary configurations.
     - For instance:
         - Database name. (DB_DATABASE)
         - Path to consume API. (API_LOCATION)
- Install dependencies.
     - Run "composer install".
- Create tables and insert default data.
     - Run "php artisan migrate --seed".

- Run the project personally I use xampp:
     - Web: http://localhost/balance/public/
     - Api: http://localhost/balance/public/api

- Another alternative to run "php artisan serve" and change the API path:
     - In the file ".env" modify "API_LOCATION" to http://localhost:8000/api 
 

## Clonar y correr el proyecto

Luego de clonar el repositorio:

- Crear una base de datos y dejarla vacia.
- Modificar el archivo ".env.example" a ".env"
    - Hacer configuraciones necesarias. 
    - Por ejemplo:
        - Nombre de la base de datos. (DB_DATABASE)
        - Ruta para consumir API. (API_LOCATION)
- Para instalar dependencias.
    - Correr "composer install".
- Para crear tablas e insertar datos predeterminados.
    - Correr "php artisan migrate --seed".

- Para correr el proyecto en lo personal utilizo xampp:
    - Web: http://localhost/balance/public/
    - Api: http://localhost/balance/public/api

- Otra alternativa correr "php artisan serve" y cambiar la ruta de la API:
    - En el archivo ".env" modificar "API_LOCATION" a http://localhost:8000/api

  
 

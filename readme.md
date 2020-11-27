 

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

  
 
<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

## Documentación
Este es el código de la prueba solicitada por LifeFile. 

## Instalación

Para el correcto funcionamiento del código, se deben realizar los siguientes pasos:

- clonar el repositorio

```
git clone https://github.com/anonibox1488/LifeFile.git

```
- Ingresar a la carpeta 
```
cd LifeFile    
```
- Intalacion de dependencias 
```
composer install
```
- Debe crear una base de datos en Mysql
- Crear el archivo .env
```
cp .env.example .env
```
- En el archivo .env modificar los valores de
```
DB_DATABASE=nombre_BD
DB_USERNAME=usuario
DB_PASSWORD=clave
```
- Ejecugar el siguiente comando para generar la clave de laravel
```
php artisan key:generate

```
- Ejecujar migraciones y Seeder
```
php artisan migrate -seed
```

- Ya puedes ejecutar el servidor y probar el codigo. 

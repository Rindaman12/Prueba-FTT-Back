
## Table of Contents


1. [Instalacion](#installation)
2. [Empezar el proyecto](#starting)
3. [Autores](#collaboration)

## Installation

<a name="installation"></a>

1: Clona el proyecto con el comando git clone junto a esta URL

```
https://github.com/Rindaman12/Prueba-FTT-Back.git
```

2: Crea la DB (MYSQL es recomendado.

3: Modifica el archivo ENV.

4: Modifica los seeders de ser necesario.

```
las credenciales del usuario Admin por defecto son: luispena@gmail.com clave: 12345678
```
## Starting The Project

<a name="starting"></a>


1: Instalar las dependencias de composer con los siguientes comandos:

```
composer install
```
o 

```
composer update 
```

2: Correr las migraciones de la DB para tener todo funcionando. 

```
php artisan migrate --seed
```

3: Instalar las dependencias de NPM

```
npm install
```

4: Compilar npm

```
npm run dev
```

o en produccion

```
npm run production or npm run prod
```


* **4.1: En caso de tener problemas con el cache o los cambios usar el siguiente comando:**

```
npm cache clear --force && sudo php artisan cache:clear && php artisan config:clear && php artisan config:cache && php artisan route:clear
```

De ultimo corre el servidor de Laravel.

```
php artisan serve
```

### Autores
<a name="collaboration"></a>

* **Luis Peña** - *Full-Stack Developer, Lead Programmer* -  Telegram: @Rindaman12, Email: luispena1098@gmail.com



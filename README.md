<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>


## Project installation guide
#### Step 1: Clone this repository

```
$ git clone https://github.com/badung7576x/itss-aims-shop-project.git
```

#### Step 2: Install library 

```
$ composer install 
```

#### Step 3: Create .env 

```
$ cp .env.example .env
$ php artisan key:generate 
```

#### Step 4: Make your database in local and setup env

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your-database
DB_USERNAME=your-username
DB_PASSWORD=your-pasaword
```

#### Step 5: Create table with data
```
$ php artisan migrate --seed
```
#### Step 6: Run server (default-port: 8000)

```
$ php artisan serve 
```

#### Demo 

Run 127.0.0.1:8000 -> Website aims

Run 127.0.0.1:8000/admin/dashboard -> Administrator system

Login information: 

- Email: admin@gmail.com

- Password: admin123


If you want to try demo online, you can access this domain: [AIMS Shop](https://itss-aims-shop.herokuapp.com/)

User: user01@gmail.com / user01 or register new account

Admin: admin@gmail.com / admin123 

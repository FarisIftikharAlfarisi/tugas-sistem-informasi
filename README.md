<h1>HOW TO INSTALL & RUN THE APP</h1>

<br/>


1.  Clone the repo

```sh
git clone https://github.com/FarisIftikharAlfarisi/tugas-sistem-informasi.git
```

2.  Change the directory to the project

```sh
cd tugas-sistem-informasi
```

3.  Install composer package

```sh
composer install
```

4.  Copy or rename `.env.example` to `.env`

```sh
cp .env.example .env
```
5.  If you using windows just copy or rename file `.env.example` to `.env`
6.  Insert your database credentials & server port in `.env`
7.  Make sure u have the database 
8.  Run the migration script
```sh
php artisan migrate
```

-   You might want to seed the tables

```sh
php artisan db:seed
```


<br/>

9.  Run the project

```sh
php artisan serve
```

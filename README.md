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
5.  Insert your database credentials & server port in `.env`
6.  Run the migration script (Make sure you already made the database!)
```sh
php artisan migrate
```

<br/>

7.  Run the project

```sh
php artisan serve
```

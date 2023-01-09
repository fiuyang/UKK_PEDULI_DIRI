# NOT FOR SALE!
***
##  LARAVEL PEDULI DIRI

- Laravel 8
- Leaflet js
- Login with Email & Phone Number
- Scanner Js
- Yajra Datatables serverside

***

## Login Admin

- email: `admin@gmail.com`
- password: `password`

---

## Cara Install
1. **Clone Repo**

```
$ git clone git@github.com:Bayudiartaa/UKK_PEDULI_DIRI.git
```
2. Jalankan perintah

```shell
# install composer-dependency
$ composer install

$ npm install

# lalu jalankan perintah
$ cp .env.example .env

# kemudian menjalankan perintah key:generate
$ php artisan key:generate
```
3. **Konfigurasi database `.env`**

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=
```    
4. **Konfigurasi smtp `.env`**

<small>untuk mendapatkan Google App Password tutorialnya <a href="https://www.febooti.com/products/automation-workshop/tutorials/enable-google-app-passwords-for-smtp.html">disini</a> </small>
```bash
# pada MAIL_PASSWORD di isi password aplikasi bukan password email

MAIL_MAILER=smtp
MAIL_HOST=smtp.googlemail.com
MAIL_PORT=587
MAIL_USERNAME=email@email.com
MAIL_PASSWORD=xxxxxxxxx
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=email@email.com
MAIL_FROM_NAME="${APP_NAME}"
```  

5. **Migrasi Database**

```bash
$ php artisan migrate
$ php artisan db:seed

# kemudian jalankan perintah
$ php artisan optimize:clear
```    
6. **Buka 2 `Terminal` dan jalankan perintah**
```bash
# menjalankan laravel
$ php artisan serve

```

<p style="color:yellow">Jangan lupa bintangnya ⭐<p>

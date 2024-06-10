# Install Package

```bash
git clone https://github.com/matdadi/dnews-test.git 
cd dnews-web
composer install
cp .env.example .env
php artisan key:generate
```

### Install node_modules

```bash
npm install
```

### Sesuaikan parameter pada file .env database dengan services yang berjalan (lewati jika pakai sail, config dibuat otomatis)

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=[nama_database]
DB_USERNAME=[username_database]
DB_PASSWORD=[user_password_database]
```

### Lakukan clear dan cache config

```bash
php artisan config:clear
php artisan config:cache
php artisan optimize
```

### jalankan migrate database dan seed dengan data dummy

```bash
php artisan migrate --seed
```

# Run App

### Pada terminal 1 jalankan perintah

```bash
php artisan serve


### Pada terminal 2 jalankan perintah

```bash
npm run dev
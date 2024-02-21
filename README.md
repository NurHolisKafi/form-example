## Installing

1. Install dependencies

```
composer install
```

```
npm install
```

2. copy .env.example dan ubah menjadi .env lalu setup database
   <br>
   <br>
3. Migrate Database beserta contoh isi datanya

```
php artisan migrate --seed
```

4. Run vite untuk mencompile file vue

```
npm run dev
```

5. Run server dan buka browser

```
php artisan serve
```

<br>
<p>Untuk dokumentasi api endpoint bisa dengan mengakses url berikut: < app_url >/api/documentation

# KARCIS

**KARCIS** adalah platform manajemen event dan tiket berbasis **Laravel 12** dengan UI bertema *neubrutalist*. Pengguna dapat menjelajahi event, memesan tiket (lengkap dengan QR code), dan menyelesaikan pembayaran melalui simulasi checkout. Organizer mengelola event miliknya sendiri, sedangkan admin memvalidasi tiket di pintu masuk dengan memindai QR code.

## Fitur Utama

- **Autentikasi pengguna** — register, login, dan logout dengan tiga peran (admin, organizer, user)
- **CRUD event oleh organizer** — buat, ubah, hapus event beserta poster
- **Booking & manajemen tiket** — pemesanan dengan cek kuota dan anti-duplikat
- **QR code tiket** — setiap tiket memiliki QR code unik untuk validasi di lokasi
- **Dashboard admin** — statistik pengguna, event, transaksi, dan validasi tiket

## Tech Stack

- **Laravel 12** (PHP 8.2+)
- **Blade** sebagai templating engine
- **Tailwind CSS** (tema neubrutalist)
- **MySQL** sebagai database
- **simple-qrcode** untuk pembuatan QR code

## Cara Setup Lokal

```bash
# 1. Clone repository
git clone <url-repo> && cd event_laravel

# 2. Salin file environment, lalu isi kredensial database
cp .env.example .env
#    Sesuaikan DB_DATABASE, DB_USERNAME, DB_PASSWORD pada file .env

# 3. Install dependency PHP
composer install

# 4. Generate application key
php artisan key:generate

# 5. Jalankan migrasi + seeder (buat dulu database 'event_management' di MySQL)
php artisan migrate --seed

# 6. Buat symlink storage agar poster event tampil
php artisan storage:link

# 7. Jalankan server pengembangan
php artisan serve
```

> Aset frontend memakai Tailwind via CDN, sehingga tidak wajib menjalankan `npm install`/Vite untuk menjalankan aplikasi.

## Akun Default Setelah Seed

Seeder (`UserSeeder`) membuat akun demo berikut — semua memakai password `password`:

| Peran     | Email                    | Password   |
|-----------|--------------------------|------------|
| Admin     | admin@admin.com          | `password` |
| Organizer | organizer@organizer.com  | `password` |
| User      | user@user.com            | `password` |
| User      | jane@user.com            | `password` |

## Struktur Folder Penting

```
app/Http/Controllers/  → Controller (Auth, Event, Ticket, Transaction, Admin/*)
app/Models/            → Eloquent model (User, Event, Ticket, Transaction)
app/Policies/          → Otorisasi kepemilikan (EventPolicy, TicketPolicy)
database/              → Migrations & seeders (UserSeeder, EventSeeder)
resources/views/       → Blade view (layouts/, events/, tickets/, admin/, auth/)
routes/web.php         → Definisi route (publik, auth, organizer, admin)
```

## Lisensi

Proyek ini dirilis di bawah lisensi [MIT](https://opensource.org/licenses/MIT).

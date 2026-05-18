# Event Management & Ticketing System
## Project Fullstack Website Berbasis Laravel

---

## 📌 Deskripsi Project
Event Management & Ticketing System merupakan aplikasi website dinamis berbasis Laravel yang digunakan untuk mengelola kegiatan event secara digital. Sistem ini memungkinkan penyelenggara event untuk membuat, mengatur, serta memonitor event dan penjualan tiket secara online.

Pengguna dapat melakukan registrasi, melihat daftar event, memesan tiket, serta memperoleh tiket digital berbentuk QR Code.

---

## 🎯 Tujuan Pengembangan
- Membuat website fullstack menggunakan framework Laravel
- Mengimplementasikan konsep MVC (Model View Controller)
- Mengelola data event secara dinamis
- Membangun sistem reservasi tiket online
- Menghasilkan sistem informasi berbasis web yang real case

---

## 👥 Aktor Sistem

### 1. Admin
- Mengelola data event
- Mengelola user
- Melihat laporan penjualan
- Memvalidasi tiket

### 2. Organizer
- Membuat event
- Mengedit event
- Mengelola kuota peserta
- Melihat peserta event

### 3. User / Peserta
- Registrasi akun
- Login sistem
- Melihat event
- Memesan tiket
- Mendapatkan QR Ticket

---

## ⚙️ Fitur Sistem

### Authentication
- Register
- Login
- Logout
- Role Management (Admin / User)

### Manajemen Event
- Tambah Event
- Edit Event
- Upload Poster Event
- Penentuan Harga Tiket
- Kuota Peserta

### Sistem Tiket
- Booking Tiket
- Status Tiket
- Generate QR Code
- Check-in Event

### Dashboard Admin
- Total Event
- Total Peserta
- Tiket Terjual
- Grafik Statistik

---

## 🧱 Teknologi yang Digunakan

- Framework : Laravel
- Bahasa Pemrograman : PHP
- Database : MySQL
- Frontend : Blade Template
- CSS Framework : Bootstrap / Tailwind CSS
- Library Tambahan :
  - Simple QR Code
  - Chart.js

---

## 🗄️ Desain Database

### Tabel Users
- id
- name
- email
- password
- role

### Tabel Events
- id
- title
- description
- date
- location
- price
- quota
- image

### Tabel Tickets
- id
- user_id
- event_id
- qr_code
- status

### Tabel Transactions
- id
- ticket_id
- payment_status
- payment_date

---

## 🔄 Alur Sistem

1. User melakukan registrasi
2. User login ke sistem
3. User memilih event
4. User melakukan pemesanan tiket
5. Sistem membuat QR Code tiket
6. Admin memvalidasi tiket saat event berlangsung
7. Data transaksi tersimpan pada dashboard

---

## 📂 Struktur Project Laravel
app/
├── Models
├── Http/Controllers
database/
├── migrations
├── seeders
resources/
├── views
routes/
├── web.php


---

## 🚀 Kelebihan Sistem
- Website dinamis berbasis MVC
- Sistem reservasi real case
- Tiket digital QR Code
- Dashboard monitoring
- Multi user role
- Responsive Web Design

---

## 📈 Pengembangan Selanjutnya
- Integrasi pembayaran online
- Notifikasi email tiket
- Scan QR Code realtime
- Export laporan PDF
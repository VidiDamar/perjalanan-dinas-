# 🛫 Project Perjalanan Dinas

Sistem Informasi Pengelolaan Perjalanan Dinas berbasis web **laravel**

---

## 🛠️ Prasyarat (Prerequisites)

Sebelum memulai, pastikan perangkat Anda telah terinstal:

* [Laragon](https://laragon.org/) (termasuk PHP >= 8.1, MySQL, dan Apache/Nginx)
* [Composer](https://getcomposer.org/)
* [Node.js & NPM](https://nodejs.org/)

---

## 🚀 Langkah Instalasi & Setup

Ikuti langkah-langkah di bawah ini untuk menjalankan project di lingkungan lokal:

### 1. Clone / Salin Repository
Buka terminal (Cmder / Git Bash) di folder `C:\laragon\www\` lalu jalankan:

```bash
cd C:\laragon\www
git clone <URL_REPOSITORY_ANDA> perjalanan-dinas
cd perjalanan-dinas
```

### 2. Instal Dependensi PHP (Composer)
Jalankan perintah berikut untuk menginstal seluruh dependensi Laravel:

```bash
composer install
```

### 3. Salin & Konfigurasi File Environment (`.env`)
Buat duplikasi file `.env.example` menjadi `.env`:

```bash
cp .env.example .env
```

Buka file `.env` dan sesuaikan pengaturan database MySQL di Laragon:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dinas_db
DB_USERNAME=root
DB_PASSWORD=
```
> **Catatan:** Pastikan Anda telah membuat database bernama `dinas_db` di MySQL/HeidiSQL Laragon.

### 4. Generate Application Key
Generate kunci enkripsi aplikasi Laravel:

```bash
php artisan key:generate
```

### 5. Jalankan Migrasi & Database Seeder
Jalankan perintah migrasi tabel beserta data awal (seeder):

```bash
php artisan migrate:fresh --seed
```

### 6. Instal & Kompilasi Asset Frontend (NPM)
Instal dependensi JavaScript/Tailwind CSS dan kompilasi asset:

```bash
npm install
```

---

## 🖥️ Menjalankan Aplikasi

jalankan app dengan perintah dibawah

### Menggunakan composer (agar running dua duanya)
1. Jalankan server lokal Laravel:
   ```bash
   composer run dev
   ```
2. Akses di browser melalui URL: `http://127.0.0.1:8000`

---

## Akun Default (Login)

Setelah seeder berhasil dijalankan, Anda dapat login menggunakan kredensial default berikut:

* **Email:** `user@gmail.com`
* **Password:** `password`

---

## 💻 Perintah Penting Selama Pengembangan

* **Reset Database dan Isikan Ulang Seeder:**
  ```bash
  php artisan migrate:fresh --seed
  ```
* **Clear Cache Aplikasi:**
  ```bash
  php artisan optimize:clear
  ```
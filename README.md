# Sistem Pelaporan Kerusakan Fasilitas

---

## Fitur Utama

- **Autentikasi Pengguna** - Login & registrasi dengan role-based access (Admin & Anggota)
- **Manajemen Laporan Kerusakan** - Buat, lihat, dan kelola laporan kerusakan fasilitas
- **Upload Bukti Foto** - Sertakan dokumentasi foto kerusakan
- **Penanganan Laporan** - Tracking status penanganan laporan
- **Manajemen Fasilitas** - Kelola data fasilitas
- **Pengumuman** - Sistem pengumuman untuk pengguna

---

## Tech Stack

| Kategori | Teknologi |
|----------|-----------|
| Backend | PHP 8.4+, Laravel 12 |
| Frontend | TailwindCSS 3.4, Alpine.js |
| Database | MySQL |
| Build Tool | Vite |
| Authentication | Laravel Sanctum |

---

## Persyaratan Sistem

Pastikan sistem  sudah terinstall:

- **PHP** >= 8.4
- **Composer** >= 2.x
- **Node.js** >= 18.x
- **NPM** >= 9.x
- **MySQL** >= 8.x

---

## Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/heisgaze/sistem-pelaporan-kerusakan.git
cd sistem-pelaporan-kerusakan
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Konfigurasi Environment

```bash
# Salin file environment
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Setup Database

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sistem_laporan_kerusakan
DB_USERNAME=root
DB_PASSWORD=your_password
```

Buat database dan jalankan migrasi:

```bash
# Buat database MySQL terlebih dahulu
mysql -u root -p -e "CREATE DATABASE sistem_laporan_kerusakan"

# Jalankan migrasi
php artisan migrate
```
### Perintah Artisan 

```bash

# Connect Storage
php artisan storage:link

# Jalankan seeder
php artisan db:seed

# Lihat semua routes
php artisan route:list
```

### Menjalankan Aplikasi

```bash

# Terminal 1
php artisan serve

# Terminal 2
npm run dev

# 2 terminal harus berjalan secara bersamaan
```

Aplikasi akan tersedia di: **http://localhost:8000**



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

## Instalasi (Local Development)

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

---

## Deploy ke Railway

### 1. Push ke GitHub
```bash
git add .
git commit -m "feat: add Railway deployment config"
git push origin main
```

### 2. Buat Project di Railway
1. Buka https://railway.app dan login dengan GitHub
2. Klik **New Project** → **Deploy from GitHub repo**
3. Pilih repository `sistem-pelaporan-kerusakan`

### 3. Tambah MySQL Database
1. Di dashboard Railway project, klik **+ New** → **Database** → **Add MySQL**
2. Railway otomatis membuat database dan variabel environment

### 4. Set Environment Variables
Di tab **Variables** pada service app, tambahkan:

```
APP_NAME=LaporFasilitas
APP_ENV=production
APP_KEY=base64:ISI_DENGAN_OUTPUT_php_artisan_key_generate_show
APP_DEBUG=false
APP_URL=https://your-app.up.railway.app
LOG_CHANNEL=stderr
LOG_LEVEL=error
DB_CONNECTION=mysql
DB_HOST=${{MySQL.MYSQLHOST}}
DB_PORT=${{MySQL.MYSQLPORT}}
DB_DATABASE=${{MySQL.MYSQLDATABASE}}
DB_USERNAME=${{MySQL.MYSQLUSER}}
DB_PASSWORD=${{MySQL.MYSQLPASSWORD}}
DB_URL=${{MySQL.MYSQL_URL}}
SESSION_DRIVER=cookie
SESSION_SECURE_COOKIE=true
SESSION_SAME_SITE=lax
CACHE_STORE=database
QUEUE_CONNECTION=sync
```

Catatan penting:
- Pastikan nama service database benar saat menulis reference variable. Jika nama servicenya bukan `MySQL`, sesuaikan prefix-nya.
- Wajib redeploy setelah ubah variables.
- Jika `DB_CONNECTION` tidak terisi benar, Laravel bisa fallback ke SQLite di container (data register tidak masuk MySQL Railway dan bisa hilang saat restart).
- Untuk cek cepat koneksi aktif, sementara set `APP_DEBUG=true`, redeploy, lalu buka endpoint `GET /debug-users` dan lihat `driver` + `database`.
- Jika kena `419 Page Expired`, ganti `SESSION_DRIVER=cookie`, pastikan akses lewat `https://` domain app, lalu redeploy.

### 5. Deploy
Railway akan otomatis build dan deploy. Cek tab **Deployments** untuk progress.

### 6. Troubleshoot Register Tidak Tersimpan
Jika register masih tidak masuk ke MySQL Railway:

1. Buka service app di Railway -> **Logs**
2. Lakukan 1x register
3. Cari log:
   - `Register attempt`
   - `Register success` atau `Register failed`

Log ini akan menampilkan `driver`, `host`, dan `database` yang benar-benar dipakai saat request.

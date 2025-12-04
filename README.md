# Ngemilku - GIS Lokasi Kuliner Kota Palu 🎯

---

## Tentang Proyek 📖

**SIG Ngemilku** adalah aplikasi Sistem Informasi Geografis (GIS) berbasis web untuk pencarian spot kuliner di Kota Palu. Aplikasi ini mendukung promosi UMKM lokal lewat pemetaan digital, membantu masyarakat menemukan tempat kuliner secara real-time, mudah, dan informatif.

**Tujuan & Manfaat:**
- Memudahkan pencarian lokasi kuliner terdekat
- Menyediakan rute & detail informasi titik kuliner
- Mendukung perkembangan UMKM kuliner Palu
- Mengaplikasikan teknologi GIS secara modern

**Fitur Utama:**
- Peta interaktif Kota Palu, marker kuliner, detail lokasi
- Pencarian lokasi & navigasi rute otomatis
- Admin dashboard: tambah/edit/hapus lokasi, kelola data kecamatan & jalan
- Public & protected endpoints untuk konsumsi data

---

## Teknologi yang Digunakan 🛠️

**Backend**
- Laravel 12
- PHP 8.2+
- MySQL

**Frontend**
- Blade
- Tailwind CSS 4
- Vite
- Leaflet.js

**Development Tools**
- Composer
- NPM
- PHPUnit

---

## Instalasi Lengkap 🚀

1. **Clone repo:**
   ```
   git clone https://github.com/NanCyfeuy/Ngemilku.git
   cd Ngemilku
   ```
2. **Install dependency backend:**
   ```
   composer install
   ```
3. **Install dependency frontend:**
   ```
   npm install
   ```
4. **Build frontend assets:**
   ```
   npm run build
   ```
5. **Copy file konfigurasi:**
   ```
   cp .env.example .env
   ```
6. **Edit `.env`:**
   - Isi data database: DB_DATABASE, DB_USERNAME, DB_PASSWORD
   - Set APP_URL sesuai kebutuhan
7. **Generate app key:**
   ```
   php artisan key:generate
   ```
8. **Setup database:**
   ```
   php artisan migrate --seed
   ```
9. **Jalankan server:**
   ```
   php artisan serve
   ```

---

## Konfigurasi ⚙️

- **File utama:**
  - `.env` = konfigurasi environment (APP_KEY, DB, MAIL, dsb.)
  - `config/database.php` = pengaturan database
- **Contoh konfigurasi:**
  ```
  APP_NAME=Ngemilku
  APP_ENV=local
  APP_KEY=base64:...
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=ngemilku
  DB_USERNAME=root
  DB_PASSWORD=
  ```
- **Penjelasan:**
  - `APP_ENV`: mode aplikasi
  - `DB_*`: pengaturan database
  - `MAIL_*`: pengiriman email (jika diperlukan)

---

## Panduan Penggunaan 📝

**URL Aplikasi**
- Publik: `/` (lihat peta, spot kuliner)
- Admin: `/admin` (dashboard kelola data)

**Alur Kelola Data Lokasi**
- Login sebagai admin
- Tambah, edit, atau hapus spot kuliner di dashboard
- Set marker & detail lokasi di peta

---

## Struktur Proyek 📂

```
Ngemilku/
├── app/
│   ├── Http/
│   ├── Models/
├── public/
│   ├── brand.png
│   ├── Poly kecamatan/
│   └── jalan.qmd
├── resources/
│   ├── views/
│   │   ├── home.blade.php
│   │   ├── admin/
│   │   └── layouts/
├── database/
│   ├── migrations/
│   ├── seeders/
├── routes/
│   └── web.php
├── .env
└── README.md
```

- **`app/Models/`**: model database
- **`public/`**: file statis, geojson, img
- **`resources/views/`**: tampilan Blade (publik & admin)
- **`database/migrations/`**: migrasi tabel
- **`routes/web.php`**: routing web

---

## Database 🗄️

**Tabel utama:**
- `users`: data admin
- `spots`: lokasi kuliner (nama, lat, long, deskripsi, jam)
- `kecamatan`: data polygon kecamatan
- `jalan`: polyline jalan utama

**Migrasi:**
```
php artisan migrate
```
**Seeder:**
```
php artisan db:seed
```

---

## Support 👥

**Kontak Developer**
- Github: [NanCyfeuy](https://github.com/NanCyfeuy)
- Email: (adnanmuftimaulana0@gmail.com)

---

> Ngemilku sebagai solusi informasi kuliner modern Kota Palu, mendukung perkembangan UMKM dan kemudahan masyarakat!

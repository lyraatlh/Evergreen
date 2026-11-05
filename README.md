<div align="center">
  <img src="public/img/pngwing.com.png" alt="Evergreen" width="120" />

  # Evergreen

  **Platform katalog dan toko tanaman berbasis Laravel**

  <p>
    Kelola koleksi tanaman, temukan tanaman favorit, dan selesaikan pembelian dalam satu pengalaman yang sederhana.
  </p>

  <p>
    <a href="#fitur">Fitur</a> •
    <a href="#teknologi">Teknologi</a> •
    <a href="#memulai">Memulai</a> •
    <a href="#struktur-proyek">Struktur</a>
  </p>

  <p>
    <img src="https://img.shields.io/badge/Laravel-12-FF2D20?logo=laravel&logoColor=white" alt="Laravel 12" />
    <img src="https://img.shields.io/badge/PHP-%5E8.2-777BB4?logo=php&logoColor=white" alt="PHP 8.2 atau lebih baru" />
    <img src="https://img.shields.io/badge/Tailwind%20CSS-4-06B6D4?logo=tailwindcss&logoColor=white" alt="Tailwind CSS 4" />
    <img src="https://img.shields.io/badge/License-MIT-green" alt="MIT License" />
  </p>
</div>

---

## Tentang Evergreen

Evergreen adalah aplikasi web untuk mengelola katalog dan penjualan tanaman. Aplikasi ini memiliki dua pengalaman utama: dashboard admin untuk mengelola tanaman dan katalog, serta area pengguna untuk menjelajahi koleksi, menyimpan favorit, mengelola keranjang, dan melakukan checkout.

## Fitur

### Untuk pengguna

- Registrasi, login, dan logout.
- Menjelajahi katalog berdasarkan jenis tanaman.
- Melihat detail tanaman dan informasi produk.
- Menambahkan tanaman ke daftar favorit.
- Menambahkan, mengubah jumlah, dan menghapus item dari keranjang.
- Proses checkout dan halaman konfirmasi pesanan.
- Mengelola profil pengguna.

### Untuk admin

- Dashboard admin.
- CRUD tanaman.
- CRUD katalog atau jenis tanaman.
- Melihat detail produk.
- Mengelola profil admin.
- Proteksi akses berbasis autentikasi dan role.

## Teknologi

- **Backend:** Laravel 12, PHP 8.2+
- **Frontend:** Blade, Tailwind CSS 4, Vite
- **Database:** MySQL
- **Testing:** PHPUnit
- **Development:** Laravel Artisan, Composer, npm

## Memulai

### Prasyarat

Pastikan perangkatmu sudah memiliki:

- PHP >= 8.2
- Composer
- Node.js dan npm
- MySQL
- Git

### Instalasi

1. Clone repository:

   ```bash
   git clone https://github.com/lyraatlh/Evergreen.git
   cd Evergreen
   ```

2. Install dependency PHP dan JavaScript:

   ```bash
   composer install
   npm install
   ```

3. Buat file environment:

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Atur koneksi database di `.env`:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=evergreenuts
   DB_USERNAME=root
   DB_PASSWORD=
   ```

   Pastikan database `evergreenuts` sudah dibuat sebelum menjalankan migrasi.

5. Jalankan migrasi dan seeder:

   ```bash
   php artisan migrate --seed
   ```

6. Jalankan aplikasi dalam mode development:

   ```bash
   composer run dev
   ```

   Buka [http://localhost:8000](http://localhost:8000) di browser.

### Menjalankan service secara terpisah

Jika tidak ingin memakai `composer run dev`, jalankan dua proses berikut di terminal terpisah:

```bash
php artisan serve
npm run dev
```

## Akun dan role

Akses aplikasi dibedakan menggunakan role:

| Role | Area | Kemampuan utama |
| --- | --- | --- |
| `admin` | `/admin` | Mengelola dashboard, tanaman, katalog, dan profil |
| `user` | `/user` | Menjelajahi katalog, favorit, keranjang, checkout, dan profil |

Buat akun melalui halaman registrasi, lalu pastikan nilai `role` pada database sesuai kebutuhan akses.

## Struktur proyek

```text
app/
├── Http/Controllers/       # Controller untuk admin, auth, katalog, dan user
├── Http/Middleware/        # Middleware autentikasi dan role
├── Models/                 # Model tanaman, katalog, keranjang, pesanan, dan user
└── Repositories/           # Abstraksi akses data produk

database/
├── migrations/             # Struktur tabel aplikasi
└── seeders/                # Data awal aplikasi

resources/
├── css/                    # Style aplikasi
├── js/                     # Entry point Vite
└── views/                  # Template Blade admin, auth, dan user

routes/web.php              # Route web aplikasi
public/                     # Asset publik dan entry point Laravel
```

## Perintah yang berguna

```bash
# Menjalankan test
php artisan test

# Membersihkan cache aplikasi
php artisan optimize:clear

# Memformat kode PHP
vendor/bin/pint

# Melihat daftar route
php artisan route:list

# Membuat link storage
php artisan storage:link
```

## Kontribusi

Kontribusi sangat terbuka. Untuk perubahan yang terstruktur:

1. Buat branch baru dari `main`.
2. Implementasikan perubahan dan tambahkan test bila diperlukan.
3. Jalankan `php artisan test` dan formatter sebelum commit.
4. Buat pull request dengan deskripsi perubahan yang jelas.

## Lisensi

Proyek ini menggunakan lisensi [MIT](https://opensource.org/licenses/MIT).

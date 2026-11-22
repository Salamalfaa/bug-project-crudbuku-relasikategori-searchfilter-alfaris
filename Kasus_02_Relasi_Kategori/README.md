# Kasus 02 — Relasi Buku dan Kategori

**Level:** Menengah  
**Fokus:** Migration, foreign key, Eloquent relationship, belongsTo, hasMany, eager loading.

## Tujuan

Mahasiswa memahami relasi one-to-many: satu kategori memiliki banyak buku, dan setiap buku dimiliki satu kategori.

## Menjalankan proyek di folder ini

Folder `Kasus_02_Relasi_Kategori` sudah menjadi proyek Laravel lengkap. Jalankan perintah dari folder ini; tidak perlu membuat proyek Laravel baru atau menyalin berkas kasus.

### Persiapan

Pastikan PHP, Composer, dan MySQL aktif. Jika `.env` belum tersedia, salin konfigurasi contoh:

```powershell
Copy-Item .env.example .env
```

Pada macOS/Linux, gunakan `cp .env.example .env`. Atur kredensial di `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bug_battle_case_02
DB_USERNAME=root
DB_PASSWORD=
```

Buat database melalui MySQL atau phpMyAdmin:

```sql
CREATE DATABASE bug_battle_case_02
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;
```

### Instalasi dan menjalankan

```bash
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed --class=CategorySeeder
php artisan optimize:clear
php artisan serve --port=8001
```

Buka [http://127.0.0.1:8001/books](http://127.0.0.1:8001/books). Port 8001 dipakai agar proyek ini dapat dijalankan bersamaan dengan Kasus 01. Untuk tes otomatis, jalankan `php artisan test`.

## Gejala yang harus diselidiki

1. Migrasi tabel buku dapat gagal atau relasinya tidak terjamin.
2. Daftar buku gagal mengambil kategori.
3. Nama kategori tidak tampil dengan benar.
4. Form buku tidak menampilkan pilihan kategori secara benar.

## Tugas

- Perbaiki foreign key `category_id`.
- Perbaiki relasi pada kedua Model.
- Perbaiki pemanggilan relasi pada Controller dan Blade.
- Pastikan satu kategori dapat memiliki banyak buku.
- Uji data buku dengan beberapa kategori.

## Uji langkah demi langkah

1. Jalankan migration dan `CategorySeeder`; tabel kategori harus berisi Teknologi, Akuntansi, dan Manajemen.
2. Buka `/books/create`; pilihan kategori harus tampil dengan ID sebagai nilai form dan nama sebagai label.
3. Tambahkan beberapa buku dan pilih kategori yang berbeda. Buku dengan kategori yang sama juga boleh ditambahkan.
4. Buka `/books`; nama kategori setiap buku harus tampil. Pastikan buku kategori sama tetap berada pada kategori yang sama.

Tampilan memakai Bootstrap dan Tailwind CSS melalui CDN; koneksi internet diperlukan untuk memuat aset antarmuka. Lihat catatan pada [README utama](../README.md#tampilan).

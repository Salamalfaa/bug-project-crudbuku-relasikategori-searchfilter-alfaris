# Kasus 03 — Pencarian dan Filter Buku

**Level:** Menengah–Lanjut  
**Fokus:** Request, query string, Eloquent, where, orWhere, LIKE, filter kategori, Blade.

## Tujuan

Mahasiswa mempelajari pencarian parsial berdasarkan judul atau penulis, lalu mempersempit hasil dengan filter kategori.

## Menjalankan proyek di folder ini

Folder `Kasus_03_Search_Filter` sudah menjadi proyek Laravel lengkap. Jalankan perintah dari folder ini; tidak perlu membuat proyek Laravel baru atau menyalin berkas kasus.

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
DB_DATABASE=bug_battle_case_03
DB_USERNAME=root
DB_PASSWORD=
```

Buat database melalui MySQL atau phpMyAdmin:

```sql
CREATE DATABASE bug_battle_case_03
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;
```

### Instalasi dan menjalankan

```bash
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan optimize:clear
php artisan serve --port=8002
```

Seeder menambahkan tiga kategori dan enam buku contoh. Buka [http://127.0.0.1:8002/books](http://127.0.0.1:8002/books). Port 8002 memungkinkan Kasus 01 dan 02 tetap aktif di port masing-masing. Untuk tes otomatis, jalankan `php artisan test`.

## Gejala yang harus diselidiki

1. Kata kunci dari form tidak terbaca oleh Controller.
2. Pencarian hanya menemukan kecocokan persis.
3. Filter kategori tidak bekerja.
4. Variabel hasil pencarian tidak tersedia di Blade.
5. Input pencarian tidak dipertahankan setelah submit.

## Tugas

- Samakan nama parameter form dan Controller.
- Gunakan pencarian parsial dengan LIKE.
- Gabungkan kondisi judul dan penulis secara benar.
- Terapkan filter kategori jika dipilih.
- Kirim hasil dan nilai filter ke View.
- Tampilkan pesan ketika hasil kosong.

## Uji langkah demi langkah

1. Jalankan migrasi dan seeder, lalu buka `/books`; daftar enam buku contoh harus tampil.
2. Cari potongan kata seperti `Lara`; *Laravel untuk Pemula* harus ditemukan dan kata kunci tetap ada di input.
3. Gabungkan kata kunci dengan filter kategori. Hasil harus cocok dengan keduanya, baik kata kunci pada judul maupun penulis.
4. Pilih kategori yang tidak memiliki buku dengan kata kunci itu; tampilkan pesan “Buku tidak ditemukan.”
5. Pilih **Reset**; daftar lengkap tampil kembali tanpa nilai filter.

Tampilan memakai Bootstrap dan Tailwind CSS melalui CDN; koneksi internet diperlukan untuk memuat aset antarmuka. Lihat catatan pada [README utama](../README.md#tampilan).

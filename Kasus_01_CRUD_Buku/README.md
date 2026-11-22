# Kasus 01 — CRUD Manajemen Buku

**Level:** Mudah  
**Fokus:** Route, Controller, Model, Migration, Blade, validasi dasar.

## Tujuan

Mahasiswa mempelajari alur MVC dengan fitur daftar, tambah, dan hapus buku.

## Menjalankan proyek di folder ini

Folder `Kasus_01_CRUD_Buku` sudah merupakan proyek Laravel lengkap. Jalankan semua perintah dari folder ini; tidak perlu membuat proyek Laravel baru atau menyalin berkas kasus ke folder lain.

### Persiapan

Pastikan PHP, Composer, dan MySQL aktif. Salin konfigurasi contoh jika `.env` belum tersedia:

```powershell
Copy-Item .env.example .env
```

Pada macOS/Linux, gunakan `cp .env.example .env`. Atur kredensial database di `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bug_battle_case_01
DB_USERNAME=root
DB_PASSWORD=
```

Buat database `bug_battle_case_01` melalui MySQL atau phpMyAdmin:

```sql
CREATE DATABASE bug_battle_case_01
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;
```

### Instalasi dan menjalankan

```bash
composer install
php artisan key:generate
php artisan migrate
php artisan optimize:clear
php artisan serve
```

Buka [http://127.0.0.1:8000/books](http://127.0.0.1:8000/books). Untuk menjalankan tes otomatis, gunakan `php artisan test`.

## Gejala yang harus diselidiki

1. Halaman daftar buku tidak dapat dibuka dengan benar.
2. Form tambah buku memiliki perilaku yang tidak sesuai.
3. Data buku tidak tampil setelah proses penyimpanan.
4. Tombol hapus tidak bekerja sebagaimana mestinya.

## Tugas

- Perbaiki routing dan kesesuaian nama method.
- Pastikan variabel yang dikirim Controller sama dengan variabel di Blade.
- Perbaiki proses penyimpanan dan penghapusan.
- Tambahkan validasi yang tepat tanpa menghilangkan fitur.
- Uji tambah, tampil, dan hapus data.

## Uji langkah demi langkah

1. Buka `/books`; saat tabel kosong, pesan bahwa belum ada data buku harus tampil.
2. Pilih **Tambah Buku**, lalu coba simpan form kosong atau tahun di luar rentang. Form harus menampilkan pesan validasi dan mempertahankan input yang valid.
3. Masukkan judul, penulis, dan tahun yang benar, lalu simpan. Buku baru harus muncul di daftar.
4. Pilih **Hapus** pada buku tersebut dan konfirmasi. Buku harus hilang dari daftar.

Tampilan menggunakan Bootstrap dan Tailwind CSS melalui CDN. Koneksi internet diperlukan untuk memuat aset. Lihat catatan pada [README utama](../README.md#tampilan).

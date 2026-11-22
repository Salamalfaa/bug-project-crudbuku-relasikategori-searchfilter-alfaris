# Bug Projek Laravel

Repositori ini berisi tiga kasus latihan Laravel. **Setiap folder kasus merupakan proyek Laravel lengkap yang dapat dijalankan langsung dari foldernya.**

## Daftar kasus

1. [Kasus 01 — CRUD Buku](Kasus_01_CRUD_Buku/README.md): daftar, tambah, validasi, dan hapus buku.
2. [Kasus 02 — Relasi Kategori](Kasus_02_Relasi_Kategori/README.md): foreign key dan relasi satu kategori ke banyak buku.
3. [Kasus 03 — Search dan Filter](Kasus_03_Search_Filter/README.md): pencarian parsial dan filter kategori.

## Cara menggunakan

Masuk ke folder kasus yang ingin dijalankan dan ikuti README di dalamnya. Setiap folder memiliki `artisan`, `composer.json`, konfigurasi, dan dependensi Laravel sendiri. Gunakan database berbeda untuk setiap kasus; jangan salin berkas antar kasus ke satu proyek karena nama route dan tabelnya berulang.

## Tampilan

Halaman kasus menggunakan Bootstrap dan utility Tailwind CSS melalui CDN sehingga browser memerlukan koneksi internet. Tailwind Play CDN digunakan untuk latihan dan pengembangan; untuk deployment produksi, ganti dengan build Tailwind lokal. Lihat panduan [Bootstrap](https://getbootstrap.com/docs/5.3/getting-started/introduction/) dan [Tailwind Play CDN](https://v3.tailwindcss.com/docs/installation/play-cdn).

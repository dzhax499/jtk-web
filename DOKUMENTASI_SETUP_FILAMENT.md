# Dokumentasi Setup & Troubleshooting Filament Admin Panel

Dokumen ini berisi rangkuman pekerjaan yang telah dilakukan untuk menghubungkan, menata, dan memperbaiki panel admin menggunakan **Filament PHP** dengan database **PostgreSQL** (Supabase).

## 1. Analisis & Perbaikan Struktur Filament Resources
- **Pengecekan Modul:** Melakukan analisis direktori `app/Filament/Resources` untuk memastikan model `User`, `Post`, `Page`, `Category`, dan `Media` telah terhubung seluruhnya ke Filament.
- **Pembersihan Redundansi:** Ditemukan adanya duplikasi resource di mana versi lama (*monolithic*) berada di root folder dan versi baru (*modular* dengan *Schemas*, *Tables*, dan *Pages* terpisah) berada di sub-folder.
- **Tindakan:** Menghapus file resource yang berpotensi menyebabkan *error/crash* dan menu duplikat, yaitu:
  - ❌ `app/Filament/Resources/CategoryResource.php`
  - ❌ `app/Filament/Resources/PageResource.php`
  - ❌ `app/Filament/Resources/PostResource.php`
- **Hasil:** Panel admin kini berjalan dengan bersih hanya menggunakan struktur modular yang rapi di dalam sub-folder masing-masing.

## 2. Konfigurasi Lingkungan (Environment)
- Menduplikasi file `.env.example` menjadi `.env`.
- Menghubungkan aplikasi ke database eksternal **PostgreSQL** yang di-*hosting* di **Supabase**.
- Menginstal dependensi utama via `composer install` dan `npm install` untuk menyiapkan eksekusi Vite.

## 3. Troubleshooting Sinkronisasi Database PostgreSQL
- **Masalah:** Saat mencoba membuat admin Filament (`php artisan make:filament-user`), terjadi error `UniqueConstraintViolationException: duplicate key value violates unique constraint "users_pkey"`.
- **Penyebab:** *Auto-increment sequence* pada PostgreSQL (`users_id_seq`) tertinggal di angka 1 dan tidak sinkron dengan *record* data yang sudah ada (mungkin karena data di-insert manual atau lewat seeder tanpa memicu *sequence*).
- **Penyelesaian:** Membuat dan mengeksekusi *script* via `php artisan tinker` untuk mereset/menyinkronkan *sequence* ke nilai ID maksimum menggunakan perintah SQL berikut:
  ```sql
  SELECT setval(pg_get_serial_sequence('users', 'id'), coalesce(max(id), 1), max(id) IS NOT null) FROM users;
  ```
- **Hasil:** *Sequence* kembali normal.

## 4. Pembuatan Akun Super Admin
- Setelah perbaikan *sequence* database, perintah `php artisan make:filament-user` berhasil dieksekusi tanpa kendala.
- **Akun yang terdaftar:**
  - **Name:** dhanu
  - **Email:** wyandhanupapoy@gmail.com
- Panel admin sekarang siap diakses di `http://127.0.0.1:8000/admin/login` menggunakan kredensial tersebut.

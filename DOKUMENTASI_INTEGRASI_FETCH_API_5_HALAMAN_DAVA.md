# Dokumentasi Integrasi Database ke Tampilan melalui Fetch API

**Project:** JTK Web - Laravel + Blade + REST API  
**Scope pengerjaan:** Berita, Prestasi, Akademik, Akreditasi, Visi Misi  
**Pengerjaan:** Integrasi tampilan 5 halaman ke data dari database melalui endpoint REST API  
**Catatan:** Dokumentasi ini dibuat untuk menjelaskan perubahan, alur data, endpoint, file yang diubah, cara menjalankan, cara menguji, dan batasan implementasi.

---

## 1. Ringkasan Pekerjaan

Pengerjaan ini menghubungkan 5 halaman frontend ke data dari database. Karena tim meminta halaman mengambil data melalui API, alur integrasi dibuat menjadi:

```text
Database Supabase
-> Laravel API Controller
-> JSON endpoint REST API
-> Blade view memakai JavaScript fetch()
-> Tampilan halaman
```

Dengan pola ini, file Blade tidak langsung melakukan query database. File Blade memanggil endpoint API, lalu data JSON yang diterima dirender ke tampilan.

Halaman yang dikerjakan:

| No | Halaman | Route Web | Sumber Data | Endpoint API |
|---:|---|---|---|---|
| 1 | Berita | `/berita` | `posts`, `media`, `categories` | `GET /api/posts` |
| 2 | Detail Berita | `/berita/{slug}` | `posts`, `media` | `GET /api/posts/{slug}` |
| 3 | Prestasi | `/prestasi` | `posts` | `GET /api/posts?type=prestasi` |
| 4 | Akademik | `/akademik` | `pages` | `GET /api/pages/akademik` |
| 5 | Akreditasi | `/akreditasi` | `pages` | `GET /api/pages/akreditasi` |
| 6 | Visi Misi | `/visi-misi` | `pages` | `GET /api/pages/visi-dan-misi` |

---

## 2. Tujuan Implementasi

Tujuan utama implementasi ini adalah:

1. Menghubungkan halaman frontend ke data database.
2. Menyediakan REST API untuk data berita/prestasi melalui resource `posts`.
3. Menggunakan REST API `pages` untuk halaman Akademik, Akreditasi, dan Visi Misi.
4. Mengubah halaman Blade agar mengambil data memakai `fetch()` ke endpoint API.
5. Menghindari data dummy/hardcoded sebagai sumber utama tampilan.
6. Memperbaiki masalah tampilan seperti tag HTML mentah, gambar rusak, dan timeout query.

---

## 3. File yang Ditambahkan atau Diubah

File utama yang terkait dengan pengerjaan ini:

```text
app/Http/Controllers/PublicController.php
app/Http/Controllers/Api/PostApiController.php
app/Http/Resources/Api/PostResource.php
routes/web.php
routes/api.php
resources/views/pages/berita.blade.php
resources/views/pages/detail-berita.blade.php
resources/views/pages/prestasi.blade.php
resources/views/pages/akademik.blade.php
resources/views/pages/akreditasi.blade.php
resources/views/pages/visi-misi.blade.php
database/seeders/DavaScopePagesSeeder.php
```

Fungsi masing-masing file:

| File | Fungsi |
|---|---|
| `PublicController.php` | Mengembalikan view untuk halaman publik. Pada versi fetch API, controller tidak lagi memuat data utama secara langsung untuk 5 halaman. |
| `PostApiController.php` | Menyediakan endpoint API untuk list posts, detail post, dan filter prestasi. |
| `PostResource.php` | Merapikan format response JSON posts, termasuk gambar, excerpt, status, dan tanggal. |
| `routes/web.php` | Mendaftarkan route frontend seperti `/berita`, `/prestasi`, `/akademik`, `/akreditasi`, `/visi-misi`. |
| `routes/api.php` | Mendaftarkan endpoint API seperti `/api/posts` dan `/api/posts/{slug}`. |
| `berita.blade.php` | Menampilkan daftar berita dengan data dari `fetch('/api/posts')`. |
| `detail-berita.blade.php` | Menampilkan detail berita dengan data dari `fetch('/api/posts/{slug}')`. |
| `prestasi.blade.php` | Menampilkan prestasi dengan data dari `fetch('/api/posts?type=prestasi')`. |
| `akademik.blade.php` | Menampilkan konten Akademik dengan data dari `fetch('/api/pages/akademik')`. |
| `akreditasi.blade.php` | Menampilkan konten Akreditasi dengan data dari `fetch('/api/pages/akreditasi')`. |
| `visi-misi.blade.php` | Menampilkan konten Visi Misi dengan data dari `fetch('/api/pages/visi-dan-misi')`. |
| `DavaScopePagesSeeder.php` | Opsional. Mengisi data awal untuk slug `akademik`, `akreditasi`, dan `visi-dan-misi` jika belum ada di tabel `pages`. |

---

## 4. Endpoint REST API

### 4.1 Endpoint Posts untuk Berita dan Prestasi

```text
GET /api/posts
GET /api/posts/{slug}
GET /api/posts?type=prestasi
GET /api/posts?category=prestasi
```

Kegunaan:

- `/api/posts` mengambil daftar berita dari tabel `posts`.
- `/api/posts/{slug}` mengambil detail satu berita berdasarkan slug.
- `/api/posts?type=prestasi` mengambil data posts yang berkaitan dengan prestasi.
- `/api/posts?category=prestasi` dapat dipakai sebagai alternatif filter prestasi.

### 4.2 Endpoint Pages untuk Akademik, Akreditasi, dan Visi Misi

```text
GET /api/pages
GET /api/pages/{slug}
```

Slug yang dipakai:

```text
akademik
akreditasi
visi-dan-misi
```

Contoh:

```text
GET /api/pages/akademik
GET /api/pages/akreditasi
GET /api/pages/visi-dan-misi
```

### 4.3 Endpoint Pendukung

```text
GET /api/categories
GET /api/media
```

Kegunaan:

- `/api/categories` menyediakan kategori yang dapat digunakan untuk filter berita.
- `/api/media` menyediakan data media/gambar.

---

## 5. Alur Data per Halaman

### 5.1 Halaman Berita

Alur:

```text
/berita
-> Blade berita.blade.php
-> fetch('/api/posts')
-> PostApiController@index
-> tabel posts + media
-> JSON
-> render card berita
```

Fitur yang diterapkan:

- Loading state saat data sedang diambil.
- Error state jika API gagal.
- Fallback gambar jika gambar dari database tidak bisa dimuat.
- Excerpt dibersihkan dari tag HTML mentah.
- Tombol kategori mengarah ke query filter.

### 5.2 Halaman Detail Berita

Alur:

```text
/berita/{slug}
-> Blade detail-berita.blade.php
-> fetch('/api/posts/{slug}')
-> PostApiController@show
-> tabel posts + media
-> JSON
-> render detail berita
```

Fitur yang diterapkan:

- Detail berita berdasarkan slug.
- Konten berita dirender sebagai HTML yang sudah diproses.
- Fallback jika detail tidak ditemukan.

### 5.3 Halaman Prestasi

Alur:

```text
/prestasi
-> Blade prestasi.blade.php
-> fetch('/api/posts?type=prestasi')
-> PostApiController@index
-> filter posts yang berkaitan dengan prestasi
-> JSON
-> render card prestasi
```

Fitur yang diterapkan:

- Data prestasi diambil dari resource `posts`.
- Filter prestasi dilakukan melalui query parameter.
- Fallback jika tidak ada data prestasi.

### 5.4 Halaman Akademik

Alur:

```text
/akademik
-> Blade akademik.blade.php
-> fetch('/api/pages/akademik')
-> PageApiController@show
-> tabel pages
-> JSON
-> render konten akademik
```

Catatan:

- Data Akademik harus tersedia di tabel `pages` dengan slug `akademik`.
- Jika data belum ada, dapat ditambahkan lewat CMS/Filament atau seeder opsional.
- Link eksternal Kalender Akademik dan Peraturan Akademik diarahkan ke situs resmi POLBAN.

### 5.5 Halaman Akreditasi

Alur:

```text
/akreditasi
-> Blade akreditasi.blade.php
-> fetch('/api/pages/akreditasi')
-> PageApiController@show
-> tabel pages
-> JSON
-> render konten akreditasi
```

Catatan:

- Data Akreditasi harus tersedia di tabel `pages` dengan slug `akreditasi`.
- Tampilan dibuat agar tidak dobel antara konten database dan card statis.
- Link sertifikat/LAM INFOKOM disiapkan sebagai link eksternal.

### 5.6 Halaman Visi Misi

Alur:

```text
/visi-misi
-> Blade visi-misi.blade.php
-> fetch('/api/pages/visi-dan-misi')
-> PageApiController@show
-> tabel pages
-> JSON
-> render konten visi misi
```

Catatan:

- Slug database yang benar adalah `visi-dan-misi`, bukan `visi-misi`.
- Route web tetap `/visi-misi`, tetapi API memakai slug database `visi-dan-misi`.

---

## 6. Data yang Dibutuhkan di Database

### 6.1 Tabel `posts`

Digunakan untuk:

- Berita
- Detail berita
- Prestasi

Kolom yang digunakan secara umum:

```text
id
title
slug
content
excerpt
status
featured_media_id
published_at
created_at
updated_at
```

### 6.2 Tabel `pages`

Digunakan untuk:

- Akademik
- Akreditasi
- Visi Misi

Slug yang harus tersedia:

```text
akademik
akreditasi
visi-dan-misi
```

Cek data dengan Tinker:

```php
DB::table('pages')
    ->select('id', 'title', 'slug')
    ->whereIn('slug', ['akademik', 'akreditasi', 'visi-dan-misi'])
    ->get();
```

Jika slug belum ada, isi lewat CMS/Filament atau jalankan seeder opsional:

```bash
php artisan db:seed --class=DavaScopePagesSeeder
```

### 6.3 Tabel `media`

Digunakan sebagai sumber gambar untuk berita/prestasi jika `featured_media_id` tersedia di `posts`.

Jika gambar tidak tersedia atau path rusak, tampilan menggunakan fallback placeholder.

---

## 7. Cara Menjalankan

Setelah file patch disalin ke project Laravel, jalankan:

```bash
composer dump-autoload
php artisan optimize:clear
php artisan route:list --path=api
php artisan serve
```

Seeder opsional:

```bash
php artisan db:seed --class=DavaScopePagesSeeder
```

Seeder hanya diperlukan jika data `akademik`, `akreditasi`, atau `visi-dan-misi` belum tersedia di tabel `pages`.

---

## 8. Cara Pengujian

### 8.1 Test Halaman Frontend

Buka URL berikut:

```text
http://localhost:8000/berita
http://localhost:8000/prestasi
http://localhost:8000/akademik
http://localhost:8000/akreditasi
http://localhost:8000/visi-misi
```

Kondisi berhasil:

- Halaman tidak error 500.
- Halaman tidak timeout.
- Data tampil dari API.
- Tidak ada tag HTML mentah di card berita/prestasi.
- Gambar rusak diganti placeholder.
- Akreditasi tidak tampil dobel.
- Visi Misi tampil rapi.

### 8.2 Test Endpoint API

```text
http://localhost:8000/api/posts
http://localhost:8000/api/posts?type=prestasi
http://localhost:8000/api/pages/akademik
http://localhost:8000/api/pages/akreditasi
http://localhost:8000/api/pages/visi-dan-misi
http://localhost:8000/api/categories
http://localhost:8000/api/media
```

Kondisi berhasil:

- Response berbentuk JSON.
- Endpoint `/api/posts` berisi data posts.
- Endpoint `/api/pages/{slug}` tidak 404 untuk slug yang sudah tersedia.

---

## 9. Troubleshooting

### 9.1 `/api/pages/akademik` atau `/api/pages/akreditasi` 404

Penyebab:

- Data slug belum ada di tabel `pages`.

Solusi:

- Tambahkan data lewat CMS/Filament.
- Atau jalankan seeder:

```bash
php artisan db:seed --class=DavaScopePagesSeeder
```

### 9.2 `/api/pages/visi-misi` 404

Penyebab:

- Slug yang benar di database adalah `visi-dan-misi`.

Solusi:

```text
Gunakan /api/pages/visi-dan-misi
```

### 9.3 Halaman `/berita` timeout

Penyebab yang pernah terjadi:

- Query ke Supabase terlalu banyak.
- Ada pengecekan Schema berulang.
- Media diambil satu per satu untuk setiap post.

Solusi di patch final:

- Data berita diambil lewat `/api/posts`.
- Query media dioptimalkan.
- Tampilan menggunakan `fetch()` sehingga halaman utama tidak melakukan query berat dari `PublicController`.

### 9.4 Error `Call to a member function contains() on string`

Penyebab yang pernah terjadi:

- Ada pemanggilan method collection/string yang tidak sesuai tipe data.

Solusi di patch final:

- Filter prestasi dipindahkan ke endpoint API dengan query parameter.
- View cukup mengambil data dari `/api/posts?type=prestasi`.

### 9.5 Gambar tidak muncul

Penyebab:

- Path gambar di database kosong.
- File media tidak tersedia di local storage.
- URL gambar tidak valid.

Solusi:

- Blade menggunakan fallback image placeholder otomatis.

### 9.6 Muncul tag `<p>` atau entity HTML di card berita

Penyebab:

- Excerpt/content dari database mengandung HTML.

Solusi:

- API/resource membersihkan excerpt untuk list/card.
- Konten detail tetap dapat dirender sebagai HTML.

---

## 10. Perintah Git yang Disarankan

Cek perubahan:

```bash
git status
git diff --stat
```

Commit:

```bash
git add .
git commit -m "Integrate five assigned pages using REST API fetch"
```

Push branch:

```bash
git push -u origin nama-branch-kamu
```

Jangan commit file berikut:

```text
.env
vendor/
node_modules/
storage/logs/
storage/framework/cache/
storage/framework/sessions/
storage/framework/views/
public/build/
```

---

## 11. Ringkasan untuk Handoff

Pengerjaan ini menyelesaikan integrasi 5 halaman ke data dari database melalui REST API fetch:

```text
/berita       -> fetch /api/posts
/prestasi     -> fetch /api/posts?type=prestasi
/akademik     -> fetch /api/pages/akademik
/akreditasi   -> fetch /api/pages/akreditasi
/visi-misi    -> fetch /api/pages/visi-dan-misi
```

Endpoint baru/utama yang digunakan:

```text
GET /api/posts
GET /api/posts/{slug}
GET /api/posts?type=prestasi
GET /api/pages
GET /api/pages/{slug}
GET /api/categories
GET /api/media
```

Status akhir:

- Frontend 5 halaman dapat mengambil data melalui API.
- API posts tersedia untuk berita dan prestasi.
- Pages API dipakai untuk Akademik, Akreditasi, dan Visi Misi.
- Fallback gambar tersedia.
- Tag HTML mentah di list berita/prestasi dibersihkan.
- Seeder tersedia sebagai opsional untuk initial content pages.

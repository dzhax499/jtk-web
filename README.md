# Dokumentasi Pengembangan CMS (Content Management System)

Dokumen ini berisi rangkuman lengkap mengenai seluruh fitur dan pembaruan yang telah dikembangkan pada proyek CMS berbasis **Laravel** dan **Filament CMS**.

## Teknologi yang Digunakan

* **Framework:** Laravel
* **Admin Panel:** Filament CMS
* **Database:** MySQL / MariaDB
* **ORM:** Eloquent ORM

---

# 1. Pembaruan Skema Database (Migrasi)

Struktur database dirancang menyerupai arsitektur WordPress dengan fokus pada relasi yang rapi dan konsisten menggunakan **Foreign Key Constraints**.

## Tabel `categories`

Menambahkan dukungan kategori bertingkat (hierarki).

### Kolom Baru

| Kolom       | Tipe               | Keterangan               |
| ----------- | ------------------ | ------------------------ |
| `parent_id` | unsignedBigInteger | Relasi ke kategori induk |

### Relasi

* `parent_id` → `categories.id`
* Menggunakan:

  ```php
  onDelete('set null')
  ```

---

## Tabel `media`

Menyesuaikan tipe data `author_id` agar sesuai dengan tabel `users`.

### Perubahan

| Kolom       | Sebelum | Sesudah            |
| ----------- | ------- | ------------------ |
| `author_id` | integer | unsignedBigInteger |

### Relasi

* `author_id` → `users.id`

---

## Tabel `pages` (Halaman Statis)

Mendukung halaman bertingkat seperti:

```text
Profil
└── Visi Misi
```

### Kolom Relasional

| Kolom               | Relasi           |
| ------------------- | ---------------- |
| `parent_id`         | ke tabel `pages` |
| `author_id`         | ke tabel `users` |
| `featured_media_id` | ke tabel `media` |

---

## Tabel `posts` (Artikel Blog)

### Kolom Relasional

| Kolom               | Relasi           |
| ------------------- | ---------------- |
| `author_id`         | ke tabel `users` |
| `featured_media_id` | ke tabel `media` |

---

# 2. Relasi Data dengan Eloquent Models

Untuk memastikan Laravel dan Filament dapat membaca relasi antar tabel dengan baik, seluruh model telah dilengkapi dengan relasi bawaan Eloquent ORM.

---

## Model `User`

### Relasi

```php
hasMany(Post::class)
hasMany(Page::class)
hasMany(Media::class)
```

### Fungsi

* Memiliki banyak postingan
* Memiliki banyak halaman
* Memiliki banyak media

---

## Model `Category`

### Relasi

```php
belongsTo(Category::class, 'parent_id')
hasMany(Category::class, 'parent_id')
```

### Fungsi

* Relasi ke kategori induk (`parent`)
* Relasi ke sub-kategori (`children`)

---

## Model `Post` & `Page`

### Relasi

```php
belongsTo(User::class, 'author_id')
belongsTo(Media::class, 'featured_media_id')
```

### Tambahan Khusus `Page`

```php
belongsTo(Page::class, 'parent_id')
hasMany(Page::class, 'parent_id')
```

### Fungsi

* Relasi penulis (`author`)
* Relasi gambar utama (`featuredMedia`)
* Struktur halaman bertingkat (`parent` dan `children`)

---

## Model `Media`

### Relasi

```php
belongsTo(User::class, 'author_id')
```

### Fungsi

* Relasi ke pengguna pengunggah media

---

# 3. Integrasi Panel Admin (Filament CMS)

Filament digunakan untuk membangun seluruh antarmuka admin (CRUD) secara otomatis tanpa perlu membuat Controller atau Blade manual.

---

# Resource yang Tersedia

## A. Category Resource

**URL:** `/admin/categories`

### Fitur Form

* Input nama kategori
* Auto-generate slug URL
* Dropdown Parent Category untuk sub-kategori

### Fitur Table

* Menampilkan:

  * Nama kategori
  * Slug
  * Parent category
* Mendukung sorting

---

## B. Media Resource

**URL:** `/admin/media`

### Fitur Form

* Upload file langsung
* Built-in Image Editor
* `author_id` otomatis diisi:

  ```php
  auth()->id()
  ```

### Fitur Table

* Preview gambar
* Judul media
* Nama uploader

---

## C. Post Resource

**URL:** `/admin/posts`

### Fitur Form

* Judul + auto slug
* Rich Editor (HTML Content)
* Status:

  * Draft
  * Publish
* Dropdown Featured Media
* Author otomatis menggunakan user login
* `published_at` menggunakan DateTime Picker

### Fitur Table

* Badge status berwarna:

  * Hijau/Biru → Publish
  * Kuning → Draft
* Menampilkan nama penulis

---

## D. Page Resource

**URL:** `/admin/pages`

### Fitur

Mirip dengan `Post Resource`, dengan tambahan:

* Dropdown Parent Page
* Struktur halaman bertingkat

Contoh:

```text
Tentang Kami
├── Visi
├── Misi
└── Struktur Organisasi
```

---

## E. User Resource

**URL:** `/admin/users`

### Fitur Form

* Kelola:

  * Nama
  * Email
  * Password
* Password:

  * Wajib saat create user
  * Otomatis di-hash sebelum disimpan

### Fitur Table

* Global search:

  * Nama
  * Email

---

# Cara Menjalankan Project

## 1. Jalankan Migrasi & Seeder

```bash
php artisan migrate:fresh --seed
```

---

## 2. Jalankan Local Server

```bash
php artisan serve
```

---

## 3. Akses Panel Admin

```text
http://localhost:8000/admin
```

---

# Akun Login Default

Gunakan akun bawaan dari seeder berikut:

| Field    | Value              |
| -------- | ------------------ |
| Email    | `test@example.com` |
| Password | `password`         |

---

# Struktur Fitur Utama

## CMS Features

* Manajemen Artikel
* Manajemen Halaman
* Hierarki Halaman
* Hierarki Kategori
* Upload Media
* Featured Image
* Multi-user Author
* Draft & Publish System
* Scheduled Publish
* Admin Panel Modern
* Auto Slug Generator

---

# Catatan Pengembangan

Arsitektur proyek dirancang modular dan scalable sehingga mudah dikembangkan untuk fitur tambahan seperti:

* Tags
* Comment System
* SEO Metadata
* Role & Permission
* API Headless CMS
* Revision History
* Menu Builder
* Theme System

---

# Penutup

Proyek CMS ini telah memiliki fondasi yang solid dengan:

* Struktur database relasional
* Integrasi penuh Laravel Eloquent
* Panel admin modern berbasis Filament
* Sistem CRUD lengkap
* Dukungan hierarki data seperti WordPress

Sehingga siap digunakan sebagai dasar pengembangan website perusahaan, portal berita, blog, maupun sistem informasi lainnya.

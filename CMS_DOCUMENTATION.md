# Dokumentasi Pengembangan CMS (Content Management System)

Dokumen ini berisi rangkuman lengkap mengenai semua pembaruan dan fitur yang telah dikembangkan di dalam proyek ini. Proyek ini menggunakan **Laravel** sebagai framework utama dan **Filament CMS** sebagai antarmuka panel kontrol admin.

---

## 1. Pembaruan Skema Database (Migrasi)
Kita telah merancang dan menyempurnakan struktur *database* yang mirip dengan arsitektur WordPress, dengan fokus pada integritas relasional (*Foreign Keys*).

- **Tabel `categories`**: Menambahkan kolom `parent_id` untuk mendukung kategori bertingkat (hierarki). Relasi ini menggunakan `onDelete('set null')`.
- **Tabel `media`**: Mengubah `author_id` ke tipe data `unsignedBigInteger` agar selaras dengan tabel `users`, lalu menambahkan relasi ke tabel pengguna.
- **Tabel `pages` (Halaman Statis)**:
  - `parent_id` (unsigned) merujuk ke tabel `pages` untuk hierarki halaman (contoh: Profil -> Visi Misi).
  - `author_id` (unsigned) merujuk ke tabel `users`.
  - `featured_media_id` (unsigned) merujuk ke tabel `media` untuk gambar utama.
- **Tabel `posts` (Artikel Blog)**:
  - `author_id` (unsigned) merujuk ke tabel `users`.
  - `featured_media_id` (unsigned) merujuk ke tabel `media`.

---

## 2. Penghubung Data: Eloquent Models
Untuk memastikan Laravel dan Filament dapat membaca relasi antar tabel dengan baik, kita telah menambahkan fungsi *relationships* bawaan Eloquent (ORM).

1. **Model `User`**:
   - Memiliki banyak Postingan (`hasMany` Posts).
   - Memiliki banyak Halaman (`hasMany` Pages).
   - Memiliki banyak Media (`hasMany` Media).
2. **Model `Category`**:
   - Berelasi dengan induknya (`belongsTo` Category as `parent`).
   - Berelasi dengan anak kategorinya (`hasMany` Category as `children`).
3. **Model `Post` & `Page`**:
   - Berelasi dengan penulis (`belongsTo` User as `author`).
   - Berelasi dengan gambar sampul (`belongsTo` Media as `featuredMedia`).
   - *(Khusus Page)* Memiliki relasi hierarki `parent()` dan `children()`.
4. **Model `Media`**:
   - Berelasi dengan pengunggah (`belongsTo` User as `author`).

---

## 3. Integrasi Panel Admin (Filament CMS)
Filament digunakan untuk men-generate seluruh antarmuka admin (CRUD) tanpa perlu menyentuh Controller atau Blade secara manual. Lima buah **Filament Resource** telah berhasil dikonfigurasi:

### A. Category Resource (`/admin/categories`)
- **Fitur Form**: Input Nama kategori akan otomatis membuat *slug* ramah URL. Terdapat dropdown untuk memilih *Parent Category* jika kategori tersebut merupakan sub-kategori.
- **Fitur Tabel**: Menampilkan nama, slug, nama parent kategori, dan bisa disorting.

### B. Media Resource (`/admin/media`)
- **Fitur Form**: Memungkinkan *File Upload* langsung (dengan Image Editor bawaan). *Author ID* disembunyikan dan diisi otomatis menggunakan ID pengguna yang sedang login (`auth()->id()`).
- **Fitur Tabel**: Menampilkan kolom *Preview Gambar*, judul media, dan uploader.

### C. Post Resource (`/admin/posts`)
- **Fitur Form**:
  - Judul dengan auto-slug.
  - **Rich Editor** untuk menyusun isi konten (HTML).
  - Pilihan Status (Draft / Publish).
  - Dropdown interaktif untuk memilih *Featured Media* (Gambar Sampul).
  - *Author* di-set otomatis menggunakan ID pengguna yang sedang login.
  - DateTime picker untuk jadwal terbit (`published_at`).
- **Fitur Tabel**: Terdapat indikator warna (*Badge*) pada status tulisan (Biru/Hijau untuk Publish, Kuning untuk Draft), beserta daftar penulis.

### D. Page Resource (`/admin/pages`)
- Hampir sama persis dengan Post Resource, dengan tambahan **Dropdown Parent Page** di Form maupun di Table agar admin bisa menyusun struktur halaman bertingkat.

### E. User Resource (`/admin/users`)
- **Fitur Form**: Form standar untuk mengelola nama dan email pengguna. Khusus untuk *Password*, inputnya wajib diisi saat pembuatan user baru, dan otomatis dienkripsi (*hashed*) sebelum disimpan.
- **Fitur Tabel**: Pencarian global berdasarkan nama dan email.

---

## Cara Menjalankan & Login
1. Jalankan migrasi dan seeder: `php artisan migrate:fresh --seed`
2. Jalankan server lokal: `php artisan serve`
3. Kunjungi URL: `http://localhost:8000/admin`
4. Login menggunakan akun pengujian bawaan *seeder*:
   - **Email**: `test@example.com`
   - **Password**: `password`

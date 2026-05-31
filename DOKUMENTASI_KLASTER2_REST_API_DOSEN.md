# Dokumentasi Klaster 2 — Struktur Data Dosen, Import Data, dan REST API

Project JTK Web — Laravel, Filament, Supabase PostgreSQL

Dokumentasi teknis untuk handoff ke Klaster 1 dan tim backend.

## 1. Ringkasan Status

Bagian Klaster 2 yang dikerjakan adalah penyediaan struktur database dosen, proses import data dosen ke Supabase, dan REST API GET agar data dapat digunakan oleh Klaster 1 atau bagian frontend.

| Komponen | Status | Catatan |
|---|---|---|
| Koneksi Supabase | Berhasil | Laravel sudah dapat membaca tabel dari schema public Supabase. |
| Data lama CMS | Ada | Data lama mencakup users, categories, media, pages, dan posts. |
| Struktur dosen | Selesai | Tabel dosen, pendidikan, mengajar, portofolio, publikasi, dan link sudah dimigrate. |
| Import data dosen | Selesai | Data dari Data_Dosen dan scrapping_scopus sudah masuk melalui staged seeder. |
| REST API | Selesai | Endpoint `/api/...` sudah terdaftar di `route:list`. |
| Integrasi Klaster 1 | Tanggung jawab Klaster 1 | View/controller mereka perlu diarahkan ke API atau model/database. |

## 2. Struktur Data

### 2.1 Tabel CMS Dasar

| Tabel | Fungsi |
|---|---|
| `users` | Data user/admin. |
| `categories` | Kategori konten. |
| `media` | Data media/gambar/file. |
| `pages` | Halaman statis. |
| `posts` | Artikel/post. |

### 2.2 Tabel Dosen dan Portofolio

| Tabel | Fungsi |
|---|---|
| `study_programs` | Data program studi yang berasal dari nilai unik `nama_prodi` pada biodata dosen. |
| `lecturers` | Biodata utama dosen: nama, slug, NIDN, gender, status, jabatan akademik, pendidikan tertinggi, dan `raw_data`. |
| `expertise_areas` | Master bidang keahlian. Saat ini bisa kosong bila data sumber tidak menyediakan bidang keahlian. |
| `expertise_area_lecturer` | Pivot many-to-many antara dosen dan bidang keahlian. |
| `lecturer_educations` | Riwayat pendidikan dosen. |
| `lecturer_teaching_histories` | Riwayat mengajar atau daftar mata kuliah yang pernah/diampu. |
| `lecturer_portfolio_items` | Portofolio dosen seperti penelitian, pengabdian, proyek, sertifikasi, dan penghargaan. |
| `lecturer_publications` | Publikasi dari Scholar/PDDIKTI/Scopus. |
| `lecturer_links` | Link eksternal dosen seperti PDDIKTI, SINTA, Google Scholar, Scopus, dan Garuda. |

## 3. Sumber Data dan Mapping Import

| Sumber File | Data yang Diambil | Masuk ke Tabel |
|---|---|---|
| `biodata.csv` | Nama dosen, prodi, gender, jabatan akademik, pendidikan tertinggi, status ikatan kerja, status aktivitas. | `lecturers`, `study_programs` |
| `riwayat.csv` | Riwayat pendidikan dan riwayat mengajar. | `lecturer_educations`, `lecturer_teaching_histories` |
| `portofolio.csv` | Penelitian/pengabdian/aktivitas portofolio dosen. | `lecturer_portfolio_items` |
| `scholar.csv` | Publikasi dari hasil pencocokan Scholar/PDDIKTI. | `lecturer_publications` |
| `scopus_detail_all.csv` | Publikasi Scopus: judul, tahun, DOI, EID, sitasi, venue, link Scopus. | `lecturer_publications`, `lecturer_links` |

Folder data mentah yang dipakai saat import:

```text
storage/app/imports/Data_Dosen
storage/app/imports/scrapping_scopus
```

## 4. Proses Import Data

Import dilakukan secara bertahap agar lebih aman untuk Supabase dan agar mudah dipantau jika terjadi timeout atau error koneksi.

| Urutan | Seeder | Fungsi |
|---|---|---|
| 0 | `LecturerResetDataSeeder` | Opsional. Reset hanya tabel dosen/portofolio jika import setengah jalan atau perlu ulang. Tidak menyentuh `pages`, `posts`, `media`, `categories`, `users`. |
| 1 | `LecturerBiodataOnlySeeder` | Import biodata utama dosen dan program studi. |
| 2 | `LecturerRiwayatOnlySeeder` | Import riwayat pendidikan dan riwayat mengajar. |
| 3 | `LecturerPortofolioOnlySeeder` | Import portofolio dosen. |
| 4 | `LecturerScholarOnlySeeder` | Import publikasi Scholar/PDDIKTI. |
| 5 | `LecturerScopusOnlySeeder` | Import publikasi Scopus dan link terkait jika tersedia. |

Perintah utama:

```bash
composer dump-autoload
php artisan db:seed --class=LecturerBiodataOnlySeeder
php artisan db:seed --class=LecturerRiwayatOnlySeeder
php artisan db:seed --class=LecturerPortofolioOnlySeeder
php artisan db:seed --class=LecturerScholarOnlySeeder
php artisan db:seed --class=LecturerScopusOnlySeeder
```

Peringatan:

- Jangan menjalankan `php artisan migrate:fresh` pada database Supabase karena dapat menghapus data lama CMS.
- Jangan menjalankan import paralel ke Supabase jika koneksi/pooler tidak stabil.
- Jika proses riwayat lama tetapi count naik, biarkan berjalan sampai selesai.

## 5. REST API yang Tersedia

| Method | Endpoint | Fungsi |
|---|---|---|
| GET | `/api/health` | Cek API hidup. |
| GET | `/api/categories` | Ambil kategori. |
| GET | `/api/media` | Ambil data media. |
| GET | `/api/pages` | Ambil daftar halaman. |
| GET | `/api/pages/{slug}` | Ambil detail halaman berdasarkan slug. |
| GET | `/api/study-programs` | Ambil daftar program studi. |
| GET | `/api/study-programs/{slug}` | Ambil detail program studi. |
| GET | `/api/lecturers` | Ambil daftar dosen. |
| GET | `/api/lecturers/{slug}` | Ambil detail dosen lengkap. |
| GET | `/api/lecturers/{slug}/portfolio` | Ambil portofolio dosen. |

Endpoint paling penting untuk halaman profil dosen Klaster 1:

```text
GET /api/lecturers
GET /api/lecturers/{slug}
GET /api/lecturers/{slug}/portfolio
```

## 6. Validasi dan Testing

### 6.1 Cek Route API

```bash
php artisan route:list --path=api
```

### 6.2 Cek Count Data

```php
php artisan tinker

collect([
    'study_programs',
    'lecturers',
    'expertise_areas',
    'lecturer_links',
    'lecturer_educations',
    'lecturer_teaching_histories',
    'lecturer_portfolio_items',
    'lecturer_publications',
])->mapWithKeys(fn ($table) => [$table => DB::table($table)->count()]);
```

### 6.3 Test API di Browser

```text
php artisan serve

http://localhost:8000/api/health
http://localhost:8000/api/lecturers
http://localhost:8000/api/lecturers/ade-chandra-nugraha
http://localhost:8000/api/study-programs
```

## 7. Catatan untuk Klaster 1

Data tidak otomatis muncul di halaman Klaster 1 hanya karena data sudah masuk ke Supabase dan API sudah tersedia. View Blade mereka harus disambungkan oleh controller atau frontend mereka.

| Kondisi | Penjelasan |
|---|---|
| View masih pakai data dummy | Jika `PublicController` masih mengirim array manual, halaman akan tetap menampilkan data contoh, bukan data Supabase. |
| Pilihan 1: Controller langsung pakai Model | Karena Klaster 1 memakai Blade Laravel, controller bisa langsung mengambil data `Lecturer` dari database dan mengirimkannya ke view. |
| Pilihan 2: Fetch REST API | Jika mereka ingin memakai API, mereka perlu JavaScript/fetch/axios untuk memanggil `/api/lecturers`. |
| Batas kerja Klaster 2 | Klaster 2 menyediakan struktur data, data, dan REST API. Integrasi tampilan menjadi tugas Klaster 1. |

## 8. Catatan Data

- `study_programs` bisa hanya berisi 1 data bila semua `biodata.csv` memiliki `nama_prodi` yang sama, misalnya “Teknik Informatika”. Pemisahan D3/D4 memerlukan mapping tambahan dari tim.
- `expertise_areas` bisa kosong karena file sumber tidak menyediakan kolom bidang keahlian yang eksplisit. Jika Klaster 1 membutuhkan section bidang keahlian, perlu input manual/mapping tambahan.
- Riwayat pendidikan dan mengajar berasal dari `riwayat.csv`. Publikasi berasal dari `scholar.csv` dan `scopus_detail_all.csv`.
- Data links eksternal bergantung pada informasi yang tersedia dalam sumber data.

## 9. File yang Boleh dan Tidak Boleh Dihapus

| File/Folder | Saran | Alasan |
|---|---|---|
| `storage/app/imports` | Boleh dihapus setelah validasi | Hanya sumber data mentah sementara. Pastikan data sudah masuk dan backup ZIP masih ada. |
| `database/seeders/Lecturer*.php` | Simpan dulu | Bukti proses import dan berguna jika perlu import ulang. |
| `app/Support/LecturerCsvImportHelper.php` | Simpan dulu | Dipakai oleh staged seeder dan dokumentasi proses import. |
| `.env` | Jangan commit | Berisi credential Supabase. |
| file ZIP/CSV data mentah | Jangan commit | File besar/sensitif dan tidak perlu masuk repo. |

Rekomendasi `.gitignore`:

```gitignore
/storage/app/imports/
/storage/app/import/
/storage/imports/
/storage/import/
*.zip
```

## 10. Troubleshooting Singkat

| Error/Gejala | Penyebab Umum | Solusi |
|---|---|---|
| Vite manifest not found | Asset frontend belum di-build atau Vite dev server belum jalan. | Jalankan `npm install` lalu `npm run dev`, atau `npm run build`. |
| column ... does not exist | Seeder mengisi kolom yang belum ada di migration. | Tambahkan migration kolom baru lalu `php artisan migrate`. |
| no connection to the server | Koneksi Supabase/pooler putus saat import lama. | Pakai staged seeder, jalankan satu per satu, jangan paralel. |
| relation ... does not exist | Model Laravel menebak nama tabel salah atau migration belum jalan. | Tambahkan `protected $table` di model atau jalankan migration. |
| undefined relationship ... | Controller memanggil relasi yang belum dibuat di Model. | Tambahkan method relationship di Model terkait. |

## 11. Checklist Handoff

- Pastikan endpoint `/api/lecturers` mengembalikan daftar dosen.
- Pastikan endpoint `/api/lecturers/{slug}` mengembalikan detail dosen.
- Pastikan `route:list --path=api` menampilkan seluruh endpoint API.
- Pastikan folder imports dan file ZIP/CSV tidak ikut commit.
- Pastikan `.env` tidak ikut commit.
- Commit migration, model, controller, route, seeder, Support helper, dan dokumentasi.

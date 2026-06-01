# Dokumentasi Implementasi Resource Dosen

**PIC:** Wyandhanu Maulidan Nugraha  
**Kelompok:** Haytham  

Dokumen ini berisi rangkuman pekerjaan yang telah dilakukan terkait pembuatan dan implementasi fitur manajemen data Dosen (Lecturer) menggunakan Filament Admin Panel, serta penjelasan teknis mengenai arsitektur _import_ data yang digunakan di dalam *project*.

---

## 1. Ringkasan Pekerjaan

Pekerjaan yang telah diselesaikan mencakup pembuatan antarmuka (UI) *admin panel* menggunakan Filament untuk mengelola data dosen beserta relasi pendukungnya. Semua skema yang dibuat menyesuaikan dengan struktur *database* yang sudah ada. 

*Resource* yang telah berhasil di-_generate_ ke dalam Filament antara lain:
1. **`Lecturer` (Biodata Utama Dosen)**
2. **`StudyProgram` (Program Studi)**
3. **`LecturerEducation` (Riwayat Pendidikan)**
4. **`LecturerPublication` (Publikasi Ilmiah & Jurnal)**

Semua perubahan ini telah di-_commit_ dan di-_push_ ke dalam *branch* `cluster2/haytham`.

---

## 2. Implementasi Filament Resource

Untuk mengelola data dari *database* secara dinamis, kami mengonversi tabel-tabel tersebut menjadi *Filament Resource*. *Resource* ini menyediakan halaman _List_ (Tabel), _Create_ (Tambah), _Edit_ (Ubah), dan _View_ (Detail) secara otomatis.

### Penyempurnaan Relasi (Foreign Key)
Dalam proses pembuatannya, skema bawaan dari *generator* disempurnakan agar lebih ramah pengguna (UX):
- **Tabel `LecturerEducation` & `LecturerPublication`**: Kolom `lecturer_id` yang awalnya berupa _input_ angka (ID) diubah menjadi **Select Dropdown** (`Select::make('lecturer_id')->relationship('lecturer', 'name')`). Hal ini memungkinkan Admin mencari dan memilih Dosen berdasarkan **Nama** dan bukan mengingat ID.
- **Tabel `Lecturer`**: Kolom `study_program_id` diubah menjadi *Select Dropdown* yang mengambil dari tabel `StudyProgram`.
- **Tabel `Lecturer` (Gender)**: Kolom gender diubah menjadi *Select Dropdown* dengan pilihan bawaan `'L' => 'Laki-laki'` dan `'P' => 'Perempuan'`.
- Pada halaman _List_ (Tabel data), relasi dipanggil menggunakan *dot notation* seperti `lecturer.name` atau `studyProgram.name`, sehingga *tabel* langsung menampilkan nama teks yang bisa dibaca.

---

## 3. Penjelasan Teknis: Kenapa Tidak Ada `ImportLecturer` di Console Commands?

Jika melihat pada folder `app/Console/Commands/`, terdapat *command* untuk *import* data dari CMS lama seperti `ImportUsers`, `ImportPosts`, `ImportMedia`, dsb. Namun, **tidak ada perintah untuk *import* dosen di sana**.

**Alasannya adalah:**
Tim *Backend* (Klaster 2) memutuskan untuk **menggunakan fitur `Seeder` bawaan Laravel** daripada *Console Command* untuk mengimpor data dosen. Berbagai *file* *import* tersebut dapat ditemukan di folder `database/seeders/` (contoh: `LecturerBiodataOnlySeeder`, `LecturerScopusOnlySeeder`).

Beberapa pertimbangan utamanya meliputi:
1. **Kompleksitas Data dan Sumber yang Beragam:**
   Data *users* atau *posts* berasal dari satu *file* JSON statis yang mudah diproses. Sedangkan data dosen bersumber dari banyak file CSV terpisah (biodata, riwayat mengajar, *scraping* Google Scholar, Scopus, dll).
2. **Mencegah Timeout dan Limitasi Memori:**
   Karena data dosen sangat masif, memecahnya menjadi banyak `Seeder` (pendekatan *staged seeder*) akan mencegah terjadinya *timeout* atau pemutusan koneksi *database* di Supabase. 
3. **Fleksibilitas (Eksekusi Bertahap):**
   Dengan *seeder* terpisah, apabila terjadi *error* di tahap publikasi Scopus, Admin tidak perlu melakukan *import* biodata dari nol lagi. Cukup jalankan spesifik `LecturerScopusOnlySeeder`.

**Cara Menjalankan Import Dosen:**
Alih-alih `php artisan import:lecturer`, perintah yang digunakan adalah:
```bash
php artisan db:seed --class=LecturerBiodataOnlySeeder
# Dilanjutkan dengan seeder spesifik lainnya.
```

---

## 4. Cara Testing

Untuk memastikan semua *Resource* yang dibuat telah berjalan dengan baik, Anda dapat melakukan pengujian dengan langkah-langkah berikut:

1. **Jalankan *Development Server***
   Pastikan *server* Laravel dan *asset bundler* aktif:
   ```bash
   php artisan serve
   npm run dev
   ```
2. **Akses Filament Admin Panel**
   Buka *browser* Anda dan kunjungi halaman *admin*:
   ```text
   http://localhost:8000/admin
   ```
   *(Catatan: Sesuaikan `/admin` dengan path Filament yang terkonfigurasi di proyek Anda).*
3. **Login Menggunakan Akun Admin**
   Gunakan kredensial Admin yang ada (biasanya diimpor dari CMS lama).
4. **Verifikasi Sidebar Menu**
   Periksa navigasi *sidebar* di sebelah kiri. Anda seharusnya melihat menu baru untuk:
   - Lecturers
   - Study Programs
   - Lecturer Educations
   - Lecturer Publications
5. **Uji Coba Fungsionalitas (CRUD)**
   - Masuk ke menu **Lecturers**. Uji pembuatan Dosen baru (*Create*). Pastikan kolom _Study Program_ dan _Gender_ memunculkan opsi *dropdown* yang bisa dipilih.
   - Masuk ke menu **Lecturer Educations**. Tekan *Create*. Pastikan bagian pencarian Dosen (`lecturer_id`) sudah berupa *dropdown* pencarian nama dosen.
   - Uji penyimpanan (*Save*), pastikan relasi tersimpan benar dan di halaman List/Tabel menampilkan **Nama Dosen** bukan angka ID.

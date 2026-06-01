# Dokumentasi Pengembangan Filament Resources - Dosen & Akademik

**PIC:** Ibnu Hilmi 
**Kelompok:** Haytham  

Dokumen ini berisi analisis lengkap dan dokumentasi perubahan terhadap **4 Filament Resources baru** yang telah ditambahkan ke dalam sistem manajemen panel admin (**Filament CMS**) pada aplikasi web JTK.

Resources ini dirancang untuk memfasilitasi pengelolaan data dosen yang lebih komprehensif, mulai dari bidang keahlian, tautan eksternal (Google Scholar, SINTA, dll), portofolio kegiatan (penelitian, pengabdian, proyek), hingga riwayat mengajar di program studi terkait.

---

## 1. Arsitektur & Pola Desain Kode

Semua resource baru ini mengikuti **pola desain terstruktur dan bersih (clean code pattern)** yang diadopsi oleh sistem ini. Konfigurasi form, infolist, dan tabel didekonstruksi (dipisah) dari kelas resource utama ke dalam sub-direktori masing-masing untuk meningkatkan keterbacaan (*readability*) dan pemeliharaan jangka panjang (*maintainability*):

- **`*Resource.php`**: Berfungsi sebagai pendaftaran rute, pengaturan navigasi panel admin, ikon menu, dan delegasi pemanggilan skema ke modul pendukung.
- **`Pages/`**: Menyimpan halaman operasional CRUD standar (`Create*`, `Edit*`, `List*`, `View*`).
- **`Schemas/`**: Menyimpan definisi elemen form (`*Form.php`) dan penampil detail data (`*Infolist.php`).
- **`Tables/`**: Menyimpan definisi kolom tabel, pencarian, pengurutan, aksi record, dan bulk action (`*Table.php`).

---

## 2. Analisis & Spesifikasi 4 Resources Baru

### A. Expertise Areas Resource (`/admin/expertise-areas`)
Resource ini digunakan untuk mengelola data **Bidang Keahlian** yang dimiliki oleh dosen.

- **Model Utama**: `App\Models\ExpertiseArea`
- **Tampilan Navigasi**: Menggunakan ikon akademik (`Heroicon::OutlinedAcademicCap`) dengan label menu berbasis nama bidang keahlian.
- **Relasi Database**: Hubungan relasional banyak-ke-banyak (*Many-to-Many* / `belongsToMany`) dengan Model `Lecturer`.
- **Komponen Skema**:
  - **Form (`ExpertiseAreaForm.php`)**:
    - `name` (TextInput): Wajib diisi, maksimal 255 karakter. Dilengkapi fitur *live JS update* untuk mengisi `slug` secara otomatis saat mengetik (*onBlur*).
    - `slug` (TextInput): Wajib diisi, berupa slug URL ramah pengguna yang dihasilkan otomatis dari nama bidang.
  - **Infolist (`ExpertiseAreaInfolist.php`)**:
    - Menampilkan entri data bidang keahlian (`name`) beserta `slug`-nya saat admin melihat detail (*view*).
  - **Table (`ExpertiseAreasTable.php`)**:
    - Kolom yang ditampilkan: `name` (bisa diurutkan & dicari) dan `slug` (bisa diurutkan & dicari).
    - Kolom tersembunyi (*toggleable*): `created_at` dan `updated_at`.
    - Aksi: View, Edit, serta Bulk Delete.

---

### B. Lecturer Links Resource (`/admin/lecturer-links`)
Resource ini berfungsi sebagai tempat penyimpanan **tautan profil akademik** resmi milik masing-masing dosen di berbagai platform eksternal.

- **Model Utama**: `App\Models\LecturerLink`
- **Tampilan Navigasi**: Menggunakan ikon tautan (`Heroicon::OutlinedLink`).
- **Relasi Database**: Hubungan *Many-to-One* (`belongsTo`) ke Model `Lecturer`.
- **Komponen Skema**:
  - **Form (`LecturerLinkForm.php`)**:
    - `lecturer_id` (Select): Dropdown relasi pencarian dosen (`lecturer`) yang di-preload untuk kecepatan akses dan bisa dicari secara interaktif.
    - `platform` (Select): Dropdown pilihan platform akademik terdefinisi dengan pilihan:
      - `pddikti` (PDDIKTI)
      - `sinta` (SINTA)
      - `google_scholar` (Google Scholar)
      - `scopus` (Scopus)
      - `garuda` (Garuda)
      - `personal_website` (Website Pribadi)
    - `url` (TextInput): Validasi khusus format URL dan wajib diisi.
  - **Infolist (`LecturerLinkInfolist.php`)**:
    - Menampilkan nama Dosen (`lecturer.name`), nama Platform, dan URL tujuan.
  - **Table (`LecturerLinksTable.php`)**:
    - Kolom yang ditampilkan: `lecturer.name` (label "Lecturer"), `platform`, dan `url` (pencarian diaktifkan).
    - Kolom tersembunyi (*toggleable*): `created_at` dan `updated_at`.
    - Fitur sorting diaktifkan pada kolom Lecturer dan Platform.

---

### C. Lecturer Portfolio Items Resource (`/admin/lecturer-portfolio-items`)
Resource ini ditujukan untuk mencatat **portofolio Tridharma perguruan tinggi dan sertifikasi** profesional yang diraih atau dikerjakan oleh dosen.

- **Model Utama**: `App\Models\LecturerPortfolioItem`
- **Tampilan Navigasi**: Menggunakan ikon tumpukan kartu (`Heroicon::OutlinedRectangleStack`).
- **Relasi Database**: Hubungan *Many-to-One* (`belongsTo`) ke Model `Lecturer`.
- **Komponen Skema**:
  - **Form (`LecturerPortfolioItemForm.php`)**:
    - `lecturer_id` (Select): Pilihan relasi dosen dengan fitur pencarian dan preload.
    - `type` (Select): Opsi kategori portofolio meliputi:
      - `research` (Penelitian)
      - `publication` (Publikasi)
      - `community_service` (Pengabdian)
      - `certification` (Sertifikasi)
      - `award` (Penghargaan)
      - `project` (Proyek)
    - `title` (Textarea): Judul kegiatan/sertifikasi, dibuat memenuhi lebar penuh baris (*columnSpanFull*).
    - `year` (TextInput): Tahun pelaksanaan (dibatasi berupa angka / *numeric*).
    - `category` (TextInput): Bidang sub-kategori spesifik.
    - `source` (TextInput): Sumber data portofolio dengan nilai bawaan (*default*) `"manual admin"`.
    - `external_url` (TextInput): Tautan eksternal yang memuat bukti dukung kegiatan (validasi format URL).
    - `description` (Textarea): Deskripsi tambahan mengenai portofolio.
    - `raw_data` (Textarea): Penyimpanan cadangan data mentah yang bersifat dinonaktifkan (*disabled*) dan memenuhi lebar penuh.
  - **Infolist (`LecturerPortfolioItemInfolist.php`)**:
    - Menyusun informasi detail portofolio dosen dengan placeholder tanda minus (`-`) jika kolom opsional bernilai kosong.
  - **Table (`LecturerPortfolioItemsTable.php`)**:
    - Kolom yang ditampilkan: `lecturer.name` (label "Lecturer"), `type`, `title` (dibatasi maksimal 50 karakter agar tabel tetap ramping), dan `year`.
    - Kolom tersembunyi (*toggleable*): `category`, `source`, `created_at`, dan `updated_at`.

---

### D. Lecturer Teaching Histories Resource (`/admin/lecturer-teaching-histories`)
Resource ini digunakan untuk mencatat secara historis **kegiatan belajar-mengajar** yang dilakukan dosen pada mata kuliah tertentu di dalam kelas.

- **Model Utama**: `App\Models\LecturerTeachingHistory`
- **Tampilan Navigasi**: Menggunakan ikon tumpukan kartu (`Heroicon::OutlinedRectangleStack`).
- **Relasi Database**: 
  - Hubungan *Many-to-One* (`belongsTo`) ke Model `Lecturer`.
  - Hubungan *Many-to-One* (`belongsTo`) ke Model `StudyProgram` (Program Studi).
- **Komponen Skema**:
  - **Form (`LecturerTeachingHistoryForm.php`)**:
    - `lecturer_id` (Select): Pilihan relasi dosen (searchable & preload).
    - `study_program_id` (Select): Pilihan relasi program studi (searchable & preload) untuk memetakan dosen mengajar di prodi mana.
    - `nidn` (TextInput): Nomor Induk Dosen Nasional saat mengajar kelas tersebut.
    - `semester_name` (TextInput): Nama semester akademik (contoh: "Ganjil 2024").
    - `course_code` (TextInput): Kode mata kuliah (contoh: "IF2204").
    - `course_name` (TextInput): Nama mata kuliah, wajib diisi dan maksimal 255 karakter.
    - `class_name` (TextInput): Nama kelas (contoh: "2A-D3").
    - `academic_year` (TextInput): Tahun akademik (contoh: "2024/2025").
    - `is_active` (Toggle): Status keaktifan riwayat mengajar (default bernilai aktif / `true`).
    - `raw_data` (Textarea): Berisi data mentah ter-serialize/JSON (jika di-sinkronisasi dari sistem lain), dinonaktifkan (*disabled*) dari perubahan manual.
  - **Infolist (`LecturerTeachingHistoryInfolist.php`)**:
    - Menampilkan seluruh detail riwayat mengajar dosen dengan komponen `IconEntry` khusus bertipe boolean untuk menampilkan status `is_active` secara visual (ikon centang hijau / silang merah).
  - **Table (`LecturerTeachingHistoriesTable.php`)**:
    - Kolom yang ditampilkan secara *default*: `lecturer.name`, `semester_name`, `course_code`, `course_name`, `class_name`, `academic_year`, dan status `is_active` (berupa IconColumn boolean).
    - Kolom opsional (*toggleable*): `studyProgram.name`, `nidn`, `created_at`, dan `updated_at`.
    - Semua kolom utama mendukung fitur *sorting* dan *searchable*.

---

## 3. Manfaat Pola Dekonstruksi Folder Resource
Dengan dipecahnya resource ke dalam 4 folder khusus (`ExpertiseAreas`, `LecturerLinks`, `LecturerPortfolioItems`, `LecturerTeachingHistories`), kode program menjadi sangat bersih karena:
1. **Tidak Ada God-Class**: File utama `*Resource.php` hanya berukuran ~50 baris kode sehingga mudah dipahami.
2. **Keterbacaan yang Tinggi**: Developer lain dapat langsung menuju `Schemas/` jika ingin mengubah tampilan form, atau menuju `Tables/` jika ingin menambahkan kolom pada tabel utama admin.
3. **Penyimpanan Terisolasi**: Konfigurasi masing-masing entitas terisolasi sempurna dan tidak saling mengintervensi satu sama lain.

<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PublicController extends Controller
{
    /**
     * Halaman Beranda
     */
    public function home(): View
    {
        $latestNews = [
            [
                'id' => 1,
                'title' => 'Wisuda Polban 2025: JTK Lahirkan Lulusan Unggul Siap Bersaing',
                'date' => '30 Agustus 2025',
                'views' => '522',
                'image' => 'https://via.placeholder.com/400x250?text=Wisuda+Polban',
                'excerpt' => 'Politeknik Negeri Bandung (Polban) mengelar Sidang Terbuka Senat Wisuda Program Magister Terapan.'
            ],
            [
                'id' => 2,
                'title' => 'Prodi Sarjana Terapan Teknik Informatika Polban Raih Akreditasi Unggul dari LAM INFOKOM',
                'date' => '19 Agustus 2025',
                'views' => '318',
                'image' => 'https://via.placeholder.com/400x250?text=Akreditasi',
                'excerpt' => 'Program Studi Sarjana Terapan Teknik Informatika di bawah Jurusan Teknik Komputer dan Informatika.'
            ]
        ];

        $programs = [
            [
                'title' => 'D3 Teknik Informatika',
                'icon' => '💻',
                'accreditation' => 'UNGGUL',
                'description' => 'Program Diploma 3 yang menghasilkan lulusan kompeten di bidang teknik informatika.'
            ],
            [
                'title' => 'Sarjana Terapan Teknik Informatika',
                'icon' => '🎓',
                'accreditation' => 'UNGGUL',
                'description' => 'Program Sarjana Terapan dengan fokus pada aplikasi teknologi informatika.'
            ]
        ];

        return view('pages.home', [
            'latestNews' => $latestNews,
            'programs' => $programs
        ]);
    }

    /**
     * Halaman Program Studi
     */
    public function programStudi(): View
    {
        return view('pages.program-studi');
    }

    /**
     * Halaman D3 Teknik Informatika
     */
    public function d3TeknikInformatika(): View
    {
        $program = [
            'title' => 'D3 Teknik Informatika',
            'shortName' => 'D3 Teknik Informatika',
            'accreditation' => 'UNGGUL',
            'accreditationDate' => 'Terakreditasi tahun 2023, Berlaku hingga 2028-08-07',
            'vision' => 'Menjadi Program Studi unggulan dan terdepan dalam program pendidikan Diploma III Teknik Informatika yang diakui baik di tingkat nasional maupun internasional pada tahun 2025.',
            'mission' => [
                'Menyelenggarakan program pendidikan di bidang Teknik Informatika yang berkualitas dan berorientasi pada kebutuhan industri.',
                'Melakukan penelitian terapan yang berdaya guna dan relevan dengan pengembangan IPTEK.',
                'Melaksanakan pengabdian kepada masyarakat melalui kegiatan-kegiatan yang berkelanjutan.'
            ],
            'objectives' => [
                'Menghasilkan tenaga di bidang perangcangan dan implementasi perangkat lunak serta perangcangan solusi bisnis berbasis teknologi informatika untuk menunjang keberlanjutan serta perancangan solusi bisnis berbasis teknologi informatika untuk menunjang keberlanjutan dan penciptaan nilai di industri lingkup nasional maupun internasional.'
            ]
        ];

        return view('pages.program-detail', ['program' => $program]);
    }

    /**
     * Halaman Sarjana Terapan Teknik Informatika
     */
    public function sarjanaTerapan(): View
    {
        $program = [
            'title' => 'Sarjana Terapan Teknik Informatika',
            'shortName' => 'Sarjana Terapan',
            'accreditation' => 'UNGGUL',
            'accreditationDate' => 'Terakreditasi tahun 2025, Berlaku hingga 2030-08-15',
            'vision' => 'Dalam satu dekade ke depan, menjadi penelitian terapan yang diakui baik oleh industri, institusi atau masyarakat baik di tingkat nasional maupun internasional pada tahun 2025.',
            'mission' => [
                'Menyelenggarakan program pendidikan di bidang perancangan sistem & teknologi informatika yang mempunyai kompetensi-kompetensi profesional yang diperlukan untuk memasuki dunia kerja.',
                'Melakukan penelitian terapan untuk pengembangan sistem dan teknologi informatika.',
                'Melaksanakan pengabdian kepada masyarakat melalui transfer teknologi dan pendampingan dalam penerapan teknologi informatika.'
            ],
            'objectives' => [
                'Menghasilkan lulusan yang kompeten, profesional dan adaptif dalam bidang sistem dan teknologi informatika.',
                'Mengembangkan pengetahuan dan keterampilan praktis dalam merancang, membangun, dan mengelola sistem informasi.',
                'Mempersiapkan lulusan untuk memasuki dunia kerja dan menjadi entrepreneur di bidang teknologi informatika.'
            ]
        ];

        return view('pages.program-detail', ['program' => $program]);
    }

    /**
     * Halaman Profil Dosen
     */
    public function profilDosen(): View
    {
        $lecturers = [
            [
                'id' => 1,
                'name' => 'Dr. Eng. Agus Setiawan, S.T., M.T.',
                'initials' => 'AS',
                'gender' => 'Laki-laki',
                'position' => 'S3 (Doktor)',
                'functional' => 'Lektor Kepala',
                'status' => 'Aktif',
                'expertise' => 'Sistem Informasi'
            ],
            [
                'id' => 2,
                'name' => 'Dr. Eng. Budi Santoso, S.T., M.T.',
                'initials' => 'BS',
                'gender' => 'Laki-laki',
                'position' => 'S3 (Doktor)',
                'functional' => 'Lektor',
                'status' => 'Aktif',
                'expertise' => 'Keamanan Informasi'
            ],
            [
                'id' => 3,
                'name' => 'Siti Nurhaliza, S.T., M.T.',
                'initials' => 'SN',
                'gender' => 'Perempuan',
                'position' => 'S2 (Magister)',
                'functional' => 'Lektor',
                'status' => 'Aktif',
                'expertise' => 'Database Management'
            ]
        ];

        $filters = [
            'program' => ['Semua Program Studi', 'D3 Teknik Informatika', 'Sarjana Terapan Teknik Informatika'],
            'field' => ['Semua Bidang Keahlian'],
            'education' => ['Semua Pendidikan Terakhir', 'S3 (Doktor)', 'S2 (Magister)'],
            'position' => ['Semua Jabatan Fungsional', 'Lektor Kepala', 'Lektor', 'Asisten Ahli']
        ];

        return view('pages.profil-dosen', [
            'lecturers' => $lecturers,
            'filters' => $filters
        ]);
    }

    /**
     * Halaman Detail Dosen
     */
    public function detailDosen($id): View
    {
        $lecturer = [
            'name' => 'Dr. Eng. Agus Setiawan, S.T., M.T.',
            'initials' => 'AS',
            'position' => 'Lektor Kepala',
            'fullName' => 'Agus Setiawan',
            'gender' => 'Laki-laki',
            'education' => 'S3 (Doktor)',
            'functional' => 'Lektor Kepala',
            'institutionalStatus' => 'Status Ikatan Kerja: Dosen Tetap',
            'activityStatus' => 'Aktif',
            'educationList' => [
                ['institution' => 'Institut Teknologi Bandung', 'degree' => 'Doktor Teknik Informatika', 'year' => '2020', 'duration' => 'S3'],
                ['institution' => 'Universitas Indonesia', 'degree' => 'Magister Teknik Informatika', 'year' => '2015', 'duration' => 'S2'],
                ['institution' => 'Politeknik Negeri Bandung', 'degree' => 'Sarjana Terapan Teknik Informatika', 'year' => '2012', 'duration' => 'D4']
            ],
            'publications' => [
                ['title' => 'Pengembangan Model Perylipan Bug Realistis dengan Teknik Fault Seeding pada Pengujian Black Box di Lingkungan Aplikasi Web', 'year' => '2025'],
                ['title' => 'Kebijakan Implementasi Program Merdeka Belajar Kampus Merdeka (MBKM) di Politeknik Negeri Bandung', 'year' => '2024'],
                ['title' => 'Peraturan Framework Learning Management System (LMS) untuk Menunjang Proses Pembelajaran Menggunakan Selenium Web Driver', 'year' => '2023']
            ]
        ];

        return view('pages.detail-dosen', ['lecturer' => $lecturer]);
    }

    /**
     * Halaman Berita
     */
    public function berita(): View
    {
        $news = [
            [
                'id' => 1,
                'title' => 'Wisuda Polban 2025: JTK Lahirkan Lulusan Unggul Siap Bersaing',
                'category' => 'Kegiatan',
                'date' => '30 Agustus 2025',
                'views' => '522',
                'image' => 'https://via.placeholder.com/400x250?text=Wisuda',
                'excerpt' => 'Politeknik Negeri Bandung (Polban) mengelar Sidang Terbuka Senat Wisuda Program Magister Terapan.'
            ],
            [
                'id' => 2,
                'title' => 'Prodi Sarjana Terapan Teknik Informatika Polban Raih Akreditasi Unggul dari LAM INFOKOM',
                'category' => 'Prestasi',
                'date' => '19 Agustus 2025',
                'views' => '318',
                'image' => 'https://via.placeholder.com/400x250?text=Akreditasi',
                'excerpt' => 'Program Studi Sarjana Terapan Teknik Informatika di bawah Jurusan Teknik Komputer dan Informatika.'
            ],
            [
                'id' => 3,
                'title' => 'JTK Raih Lulusan D3 Terbaik di Wisuda POLBAN 2020',
                'category' => 'Prestasi',
                'date' => '26 Agustus 2020',
                'views' => '191',
                'image' => 'https://via.placeholder.com/400x250?text=Lulusan',
                'excerpt' => 'Sabtu (14/11/2020), Politeknik Negeri Bandung menggelar Sidang Terbuka Senat Politeknik Negeri Bandung.'
            ]
        ];

        $categories = ['Semua Berita', 'Kegiatan', 'Prestasi', 'Pengumuman', 'Akademik'];

        return view('pages.berita', [
            'news' => $news,
            'categories' => $categories
        ]);
    }

    /**
     * Halaman Detail Berita
     */
    public function detailBerita($id): View
    {
        $article = [
            'title' => 'Wisuda Polban 2025: JTK Lahirkan Lulusan Unggul Siap Bersaing',
            'date' => '30 Agustus 2025',
            'views' => '522',
            'image' => 'https://via.placeholder.com/800x400?text=Wisuda',
            'content' => 'Politeknik Negeri Bandung (Polban) mengelar Sidang Terbuka Senat Wisuda Program Magister Terapan dan Teknik Informatika yang menghasilan lulusan dengan kompetensi tinggi.'
        ];

        return view('pages.detail-berita', ['article' => $article]);
    }

    /**
     * Halaman Prestasi
     */
    public function prestasi(): View
    {
        $achievements = [
            [
                'id' => 1,
                'title' => 'Mahasiswa JTK POLBAN Raih Prestasi Membanggakan di KMIPY VII 2025 di Padang',
                'date' => '18 Oktober 2025',
                'views' => '152',
                'image' => 'https://via.placeholder.com/300x200?text=Prestasi+1'
            ],
            [
                'id' => 2,
                'title' => 'Obstetrik dari JTK Sabet Juara I Hackathon BuildOn Indonesia 2020',
                'date' => '15 Agustus 2025',
                'views' => '39',
                'image' => 'https://via.placeholder.com/300x200?text=Prestasi+2'
            ],
            [
                'id' => 3,
                'title' => 'Mahasiswa JTK Raih Prestasi dalam Program Nyatakan.id Kemenprakraf',
                'date' => '22 Agustus 2020',
                'views' => '151',
                'image' => 'https://via.placeholder.com/300x200?text=Prestasi+3'
            ]
        ];

        return view('pages.prestasi', ['achievements' => $achievements]);
    }

    /**
     * Halaman Arsip (Berita + Prestasi Mahasiswa)
     */
    public function arsipBerita(): View
    {
        $news = [
            [
                'id' => 1,
                'title' => 'Wisuda Polban 2025: JTK Lahirkan Lulusan Unggul Siap Bersaing',
                'category' => 'Kegiatan',
                'date' => '30 Agustus 2025',
                'views' => '522',
                'image' => 'https://via.placeholder.com/400x250?text=Wisuda',
                'excerpt' => 'Politeknik Negeri Bandung (Polban) mengelar Sidang Terbuka Senat Wisuda Program Magister Terapan.',
                'type' => 'berita'
            ],
            [
                'id' => 2,
                'title' => 'Prodi Sarjana Terapan Teknik Informatika Polban Raih Akreditasi Unggul dari LAM INFOKOM',
                'category' => 'Prestasi',
                'date' => '19 Agustus 2025',
                'views' => '318',
                'image' => 'https://via.placeholder.com/400x250?text=Akreditasi',
                'excerpt' => 'Program Studi Sarjana Terapan Teknik Informatika di bawah Jurusan Teknik Komputer dan Informatika.',
                'type' => 'prestasi'
            ],
            [
                'id' => 3,
                'title' => 'JTK Raih Lulusan D3 Terbaik di Wisuda POLBAN 2020',
                'category' => 'Prestasi',
                'date' => '26 Agustus 2020',
                'views' => '191',
                'image' => 'https://via.placeholder.com/400x250?text=Lulusan',
                'excerpt' => 'Sabtu (14/11/2020), Politeknik Negeri Bandung menggelar Sidang Terbuka Senat Politeknik Negeri Bandung.',
                'type' => 'prestasi'
            ]
        ];

        return view('pages.arsip-berita', ['news' => $news]);
    }

    /**
     * Halaman Arsip Prestasi (Deprecated - use arsipBerita instead)
     */
    public function arsipPrestasi(): View
    {
        return $this->arsipBerita();
    }

    /**
     * Halaman Akademik
     */
    public function akademik(): View
    {
        return view('pages.akademik');
    }

    /**
     * Halaman Akreditasi
     */
    public function akreditasi(): View
    {
        $accreditations = [
            [
                'program' => 'D3 Teknik Informatika',
                'status' => 'UNGGUL',
                'date' => 'Terakreditasi tahun 2023, Berlaku hingga 2028-08-07',
                'noSk' => 'No. SK: 0753/SK/LAM-INFOKOM/Ak/D3/VII/2023',
                'certificate' => 'Sertifikat Akreditasi dapat diakses melalui Web LAM INFOKOM.'
            ],
            [
                'program' => 'Sarjana Terapan Teknik Informatika',
                'status' => 'UNGGUL',
                'date' => 'Terakreditasi tahun 2025, Berlaku hingga 2030-08-15',
                'noSk' => 'No. SK: 145/SK/LAM-INFOKOM/Ak/STT/VIII/2025',
                'certificate' => 'Sertifikat Akreditasi dapat diakses melalui Web LAM INFOKOM.'
            ]
        ];

        return view('pages.akreditasi', ['accreditations' => $accreditations]);
    }

    /**
     * Halaman Tentang JTK
     */
    public function tentangJTK(): View
    {
        return view('pages.tentang-jtk');
    }

    /**
     * Halaman Fasilitas
     */
    public function fasilitas(): View
    {
        return view('pages.fasilitas');
    }

    /**
     * Halaman Visi dan Misi
     */
    public function visiMisi(): View
    {
        return view('pages.visi-misi');
    }

    /**
     * Halaman Struktur Organisasi
     */
    public function strukturOrganisasi(): View
    {
        return view('pages.struktur-organisasi');
    }

    /**
     * Halaman Hasil Penelitian
     */
    public function hasilPenelitian(): View
    {
        return view('pages.hasil-penelitian');
    }

    /**
     * Halaman Riwayat Singkat
     */
    public function riwayatSingkat(): View
    {
        return view('pages.riwayat-singkat');
    }

    /**
     * Halaman Produk
     */
    public function produk(): View
    {
        return view('pages.produk');
    }

    /**
     * Halaman Tenaga Kependidikan
     */
    public function tenagaKependidikan(): View
    {
        return view('pages.tenaga-kependidikan');
    }

    /**
     * Halaman Reputasi
     */
    public function reputasi(): View
    {
        return view('pages.reputasi');
    }

    /**
     * Halaman Kompetensi Lulusan
     */
    public function kompetensiLulusan(): View
    {
        return view('pages.kompetensi-lulusan');
    }
}

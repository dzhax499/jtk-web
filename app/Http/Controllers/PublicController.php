<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PublicController extends Controller
{
    /**
     * Halaman Beranda
     */
    public function home(): View
    {
        return view('pages.home', [
            'latestNews' => $this->getStaticLatestNews(),
            'programs' => $this->getStaticPrograms(),
        ]);
    }

    /**
     * Halaman Program Studi
     */
    public function programStudi(): View
    {
        return view('pages.program-studi', [
            'page' => $this->getPageBySlug('program-studi'),
            'pageContent' => $this->getPageContent('program-studi'),
        ]);
    }

    /**
     * Halaman D3 Teknik Informatika
     */
    public function d3TeknikInformatika(): View
    {
        return view('pages.program-detail', [
            'program' => [
                'title' => 'D3 Teknik Informatika',
                'shortName' => 'D3 Teknik Informatika',
                'accreditation' => 'UNGGUL',
                'accreditationDate' => 'Terakreditasi tahun 2023, Berlaku hingga 2028-08-07',
                'vision' => 'Menjadi Program Studi unggulan dan terdepan dalam program pendidikan Diploma III Teknik Informatika yang diakui baik di tingkat nasional maupun internasional.',
                'mission' => [
                    'Menyelenggarakan program pendidikan di bidang Teknik Informatika yang berkualitas dan berorientasi pada kebutuhan industri.',
                    'Melakukan penelitian terapan yang relevan dengan pengembangan IPTEK.',
                    'Melaksanakan pengabdian kepada masyarakat melalui kegiatan yang berkelanjutan.',
                ],
                'objectives' => [
                    'Menghasilkan lulusan yang kompeten dalam perancangan dan implementasi perangkat lunak.',
                    'Menghasilkan lulusan yang mampu menyelesaikan masalah berbasis teknologi informasi.',
                ],
            ],
        ]);
    }

    /**
     * Halaman Sarjana Terapan Teknik Informatika
     */
    public function sarjanaTerapan(): View
    {
        return view('pages.program-detail', [
            'program' => [
                'title' => 'Sarjana Terapan Teknik Informatika',
                'shortName' => 'Sarjana Terapan',
                'accreditation' => 'UNGGUL',
                'accreditationDate' => 'Terakreditasi tahun 2025, Berlaku hingga 2030-08-15',
                'vision' => 'Menjadi program studi sarjana terapan yang unggul dalam bidang sistem dan teknologi informatika.',
                'mission' => [
                    'Menyelenggarakan pendidikan di bidang sistem dan teknologi informatika.',
                    'Melakukan penelitian terapan untuk pengembangan teknologi informatika.',
                    'Melaksanakan pengabdian kepada masyarakat melalui transfer teknologi.',
                ],
                'objectives' => [
                    'Menghasilkan lulusan yang kompeten, profesional, dan adaptif dalam bidang informatika.',
                    'Mengembangkan keterampilan praktis dalam merancang, membangun, dan mengelola sistem informasi.',
                ],
            ],
        ]);
    }

    /**
     * Halaman Profil Dosen
     *
     * Catatan penting:
     * Bagian ini sengaja memakai Query Builder langsung dan tidak mengakses relasi
     * expertiseAreas. Tujuannya agar aman saat memakai Supabase pooler dan menghindari
     * N+1 query / error prepared statement pada halaman /profil-dosen.
     */
    public function profilDosen(): View
    {
        if (!Schema::hasTable('lecturers')) {
            return view('pages.profil-dosen', [
                'lecturers' => [],
                'filters' => $this->emptyLecturerFilters(),
            ]);
        }

        $lecturersData = DB::table('lecturers')
            ->select([
                'id',
                'name',
                'slug',
                'gender',
                'highest_education',
                'academic_position',
                'activity_status',
            ])
            ->orderBy('name')
            ->get();

        $lecturers = $lecturersData
            ->map(function ($lecturer) {
                return [
                    'id' => $lecturer->slug ?? $lecturer->id,
                    'name' => $lecturer->name ?? '-',
                    'initials' => $this->getInitials($lecturer->name ?? '-'),
                    'gender' => $lecturer->gender ?? '-',
                    'position' => $lecturer->highest_education ?? '-',
                    'functional' => $lecturer->academic_position ?? '-',
                    'status' => $lecturer->activity_status ?? '-',

                    // Untuk keamanan merge, bidang keahlian tidak diambil dari relasi dulu.
                    // Relasi expertise bisa diaktifkan lagi nanti oleh pemegang halaman dosen
                    // setelah query-nya dibuat eager loading / join yang aman.
                    'expertise' => '-',
                ];
            })
            ->toArray();

        $educationFilters = $lecturersData
            ->pluck('highest_education')
            ->filter()
            ->unique()
            ->sort()
            ->values()
            ->toArray();

        $positionFilters = $lecturersData
            ->pluck('academic_position')
            ->filter()
            ->unique()
            ->sort()
            ->values()
            ->toArray();

        return view('pages.profil-dosen', [
            'lecturers' => $lecturers,
            'filters' => [
                'program' => ['Semua Program Studi', 'Teknik Informatika'],
                'field' => ['Semua Bidang Keahlian'],
                'education' => array_merge(['Semua Pendidikan Terakhir'], $educationFilters),
                'position' => array_merge(['Semua Jabatan Fungsional'], $positionFilters),
            ],
        ]);
    }

    /**
     * Halaman Detail Dosen
     */
    public function detailDosen($id): View
    {
        abort_unless(Schema::hasTable('lecturers'), 404);

        $lecturerModel = Lecturer::with([
                'educations',
                'teachingHistories',
                'portfolioItems',
                'publications',
                'links',
            ])
            ->where(function ($query) use ($id) {
                $query->where('slug', $id);

                if (is_numeric($id)) {
                    $query->orWhere('id', $id);
                }
            })
            ->firstOrFail();

        $educationList = $lecturerModel->educations
            ->sortBy([
                ['sort_order', 'asc'],
                ['graduation_year', 'desc'],
            ])
            ->map(function ($education) {
                return [
                    'institution' => $education->institution_name ?? '-',
                    'degree' => $education->degree ?? $education->study_program ?? '-',
                    'year' => $education->graduation_year ?? '-',
                    'duration' => $education->degree_level ?? '-',
                ];
            })
            ->values()
            ->toArray();

        $teachingHistoryList = $lecturerModel->teachingHistories
            ->sortByDesc('academic_year')
            ->map(fn ($history) => [
                'course' => $history->course_name ?? '-',
                'year' => $history->academic_year ?? '-',
                'semester' => $history->semester ?? '-',
            ])
            ->values()
            ->toArray();

        $researchList = $lecturerModel->portfolioItems
            ->where('type', 'research')
            ->sortByDesc('year')
            ->map(fn ($item) => [
                'title' => $item->title ?? '-',
                'year' => $item->year ?? '-',
            ])
            ->values()
            ->toArray();

        $communityServiceList = $lecturerModel->portfolioItems
            ->where('type', 'community_service')
            ->sortByDesc('year')
            ->map(fn ($item) => [
                'title' => $item->title ?? '-',
                'year' => $item->year ?? '-',
            ])
            ->values()
            ->toArray();

        $publicationList = $lecturerModel->publications
            ->sortByDesc('year')
            ->map(fn ($pub) => [
                'title' => $pub->title ?? '-',
                'year' => $pub->year ?? '-',
            ])
            ->values()
            ->toArray();

        $hkiList = $lecturerModel->portfolioItems
            ->whereIn('type', ['hki', 'patent', 'award'])
            ->sortByDesc('year')
            ->map(fn ($item) => [
                'title' => $item->title ?? '-',
                'year' => $item->year ?? '-',
            ])
            ->values()
            ->toArray();

        $portfolioPublications = $lecturerModel->portfolioItems
            ->sortByDesc('year')
            ->map(fn ($item) => [
                'title' => $item->title ?? '-',
                'year' => $item->year ?? '-',
            ]);

        $scientificPublications = $lecturerModel->publications
            ->sortByDesc('year')
            ->map(fn ($publication) => [
                'title' => $publication->title ?? '-',
                'year' => $publication->year ?? '-',
            ]);

        return view('pages.detail-dosen', [
            'lecturer' => [
                'name' => $lecturerModel->name ?? '-',
                'initials' => $this->getInitials($lecturerModel->name ?? '-'),
                'position' => $lecturerModel->academic_position ?? '-',
                'fullName' => $lecturerModel->name ?? '-',
                'gender' => $lecturerModel->gender ?? '-',
                'education' => $lecturerModel->highest_education ?? '-',
                'functional' => $lecturerModel->academic_position ?? '-',
                'institutionalStatus' => 'Status Ikatan Kerja: ' . ($lecturerModel->employment_status ?? '-'),
                'activityStatus' => $lecturerModel->activity_status ?? '-',
                'educationList' => $educationList,
                'teachingHistoryList' => $teachingHistoryList,
                'researchList' => $researchList,
                'communityServiceList' => $communityServiceList,
                'publicationList' => $publicationList,
                'hkiList' => $hkiList,
                'publications' => $portfolioPublications
                    ->merge($scientificPublications)
                    ->filter(fn ($publication) => !empty($publication['title']) && $publication['title'] !== '-')
                    ->take(20)
                    ->values()
                    ->toArray(),
            ],
        ]);
    }

    /**
     * Halaman Berita
     *
     * Data halaman ini diambil oleh Blade menggunakan fetch API ke /api/posts.
     */
    public function berita(): View
    {
        return view('pages.berita');
    }

    /**
     * Halaman Detail Berita
     *
     * Data detail diambil oleh Blade menggunakan fetch API ke /api/posts/{slug}.
     */
    public function detailBerita($id): View
    {
        return view('pages.detail-berita', ['slug' => $id]);
    }

    /**
     * Halaman Prestasi
     *
     * Data halaman ini diambil oleh Blade menggunakan fetch API ke /api/posts?type=prestasi.
     */
    public function prestasi(): View
    {
        return view('pages.prestasi');
    }

    /**
     * Halaman Arsip Berita
     */
    public function arsipBerita(): View
    {
        return view('pages.berita');
    }

    /**
     * Halaman Arsip Prestasi
     */
    public function arsipPrestasi(): View
    {
        return view('pages.prestasi');
    }

    /**
     * Halaman Akademik
     *
     * Konten CMS diambil oleh Blade menggunakan fetch API ke /api/pages/akademik.
     */
    public function akademik(): View
    {
        return view('pages.akademik');
    }

    /**
     * Halaman Akreditasi
     *
     * Konten CMS diambil oleh Blade menggunakan fetch API ke /api/pages/akreditasi.
     */
    public function akreditasi(): View
    {
        return view('pages.akreditasi');
    }

    /**
     * Halaman Tentang JTK
     */
    public function tentangJTK(): View
    {
        return view('pages.tentang-jtk', [
            'page' => $this->getPageBySlug('tentang-jtk'),
            'pageContent' => $this->getPageContent('tentang-jtk'),
        ]);
    }

    /**
     * Halaman Fasilitas
     */
    public function fasilitas(): View
    {
        return $this->renderPageFromApi('fasilitas', 'pages.fasilitas');
    }

    /**
     * Halaman Visi dan Misi
     *
     * Konten CMS diambil oleh Blade menggunakan fetch API ke /api/pages/visi-dan-misi.
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
        return $this->renderPageFromApi('struktur-organisasi', 'pages.struktur-organisasi');
    }

    /**
     * Halaman Hasil Penelitian
     */
    public function hasilPenelitian(): View
    {
        return $this->renderPageFromApi('hasil-penelitian', 'pages.hasil-penelitian');
    }

    /**
     * Halaman Riwayat Singkat
     */
    public function riwayatSingkat(): View
    {
        return $this->renderPageFromApi('riwayat-singkat', 'pages.riwayat-singkat');
    }

    /**
     * Halaman Produk
     */
    public function produk(): View
    {
        return $this->renderPageFromApi('produk', 'pages.produk');
    }

    /**
     * Halaman Tenaga Kependidikan
     */
    public function tenagaKependidikan(): View
    {
        return $this->renderPageFromApi('tenaga-kependidikan', 'pages.tenaga-kependidikan');
    }

    /**
     * Halaman Reputasi
     */
    public function reputasi(): View
    {
        return $this->renderPageFromApi('reputasi', 'pages.reputasi');
    }

    /**
     * Halaman Kompetensi Lulusan
     */
    public function kompetensiLulusan(): View
    {
        return $this->renderPageFromApi('kompetensi-lulusan', 'pages.kompetensi-lulusan');
    }

    /**
     * Helper: Mengambil data halaman dari REST API secara internal,
     * lalu mengirimkannya ke view Blade yang sesuai.
     */
    private function renderPageFromApi(string $slug, string $viewName): View
    {
        try {
            $response = app(PageApiController::class)->show($slug);
            $pageData = $response->resolve();
        } catch (\Throwable $e) {
            $pageData = [
                'title' => ucwords(str_replace('-', ' ', $slug)),
                'content' => null,
            ];
        }

        return view($viewName, [
            'page' => $pageData,
            'pageContent' => $pageData['content'] ?? null,
        ]);
    }

    private function getStaticLatestNews(): array
    {
        return [
            [
                'id' => 1,
                'title' => 'Wisuda Polban 2025: JTK Lahirkan Lulusan Unggul Siap Bersaing',
                'date' => '30 Agustus 2025',
                'views' => '522',
                'image' => 'https://placehold.co/400x250?text=Wisuda+Polban',
                'excerpt' => 'Politeknik Negeri Bandung menggelar Sidang Terbuka Senat Wisuda Program Magister Terapan.',
            ],
            [
                'id' => 2,
                'title' => 'Prodi Sarjana Terapan Teknik Informatika Polban Raih Akreditasi Unggul dari LAM INFOKOM',
                'date' => '19 Agustus 2025',
                'views' => '318',
                'image' => 'https://placehold.co/400x250?text=Akreditasi',
                'excerpt' => 'Program Studi Sarjana Terapan Teknik Informatika meraih predikat akreditasi unggul.',
            ],
        ];
    }

    private function getStaticPrograms(): array
    {
        return [
            [
                'title' => 'D3 Teknik Informatika',
                'icon' => '💻',
                'accreditation' => 'UNGGUL',
                'description' => 'Program Diploma 3 yang menghasilkan lulusan kompeten di bidang teknik informatika.',
            ],
            [
                'title' => 'Sarjana Terapan Teknik Informatika',
                'icon' => '🎓',
                'accreditation' => 'UNGGUL',
                'description' => 'Program Sarjana Terapan dengan fokus pada aplikasi teknologi informatika.',
            ],
        ];
    }

    private function getPageBySlug(string $slug): ?object
    {
        if (!Schema::hasTable('pages')) {
            return null;
        }

        return DB::table('pages')
            ->where('slug', $slug)
            ->first();
    }

    private function getPageContent(string $slug): ?string
    {
        $page = $this->getPageBySlug($slug);

        if (!$page) {
            return null;
        }

        return $this->cleanHtml($page->content ?? $page->body ?? '');
    }

    private function cleanHtml(?string $html): string
    {
        if (!$html) {
            return '';
        }

        return html_entity_decode($html, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }

    private function getInitials(string $name): string
    {
        $parts = collect(explode(' ', trim($name)))
            ->filter()
            ->values();

        if ($parts->isEmpty()) {
            return '-';
        }

        return $parts
            ->take(2)
            ->map(fn ($part) => Str::upper(Str::substr($part, 0, 1)))
            ->implode('');
    }

    private function emptyLecturerFilters(): array
    {
        return [
            'program' => ['Semua Program Studi'],
            'field' => ['Semua Bidang Keahlian'],
            'education' => ['Semua Pendidikan Terakhir'],
            'position' => ['Semua Jabatan Fungsional'],
        ];
    }
}

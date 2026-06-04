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
        try {
            $programsRequest = request()->duplicate();
            $programsResponse = app(\App\Http\Controllers\Api\StudyProgramApiController::class)->index($programsRequest);
            $programsData = $programsResponse->resolve();
            $programs = collect($programsData)->map(function ($program) {
                return [
                    'title' => $program['name'] ?? 'Program Studi',
                    'slug' => $program['slug'] ?? '#',
                    'icon' => str_contains(strtolower($program['degree'] ?? ''), 'd3') ? '💻' : '🎓',
                    'accreditation' => 'UNGGUL',
                    'description' => $program['description'] ?? 'Program studi unggulan yang menghasilkan lulusan kompeten.',
                ];
            })->toArray();
        } catch (\Throwable $e) {
            $programs = $this->getStaticPrograms();
        }

        try {
            $newsRequest = request()->duplicate(['type' => 'berita', 'per_page' => 5]);
            $newsResponse = app(\App\Http\Controllers\Api\PostApiController::class)->index($newsRequest);
            $latestNewsData = $newsResponse->resolve();
            $latestNews = collect($latestNewsData)->map(function ($news) {
                return [
                    'id' => $news['slug'] ?? $news['id'],
                    'title' => $news['title'],
                    'date' => $news['date_label'] ?? '-',
                    'views' => $news['views'] ?? '0',
                    'image' => $news['image_url'] ?? 'https://via.placeholder.com/400x250?text=Berita',
                    'excerpt' => $news['excerpt'],
                    'slug' => $news['slug'] ?? $news['id'],
                ];
            })->toArray();
        } catch (\Throwable $e) {
            $latestNews = $this->getStaticLatestNews();
        }

        return view('pages.home', [
            'latestNews' => $latestNews,
            'programs' => $programs,
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
     * Halaman Detail Program Studi
     */
    public function programDetail(string $slug): View
    {
        return view('pages.program-detail', [
            'slug' => $slug
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
                'selected' => [
                    'search' => '',
                    'program' => [],
                    'education' => [],
                    'position' => [],
                ]
            ]);
        }

        // Get all unique filter options from DB (without dynamic queries applied, to keep options constant)
        $allLecturersForFilters = DB::table('lecturers')
            ->select(['highest_education', 'academic_position'])
            ->get();

        $educationFilters = $allLecturersForFilters
            ->pluck('highest_education')
            ->filter(function ($value) {
                $value = trim($value ?? '');
                if (empty($value) || $value === '-' || preg_match('/[0-9]{5,}/', $value) || str_contains(strtolower($value), 'oakw') || strlen($value) > 50) {
                    return false;
                }
                return true;
            })
            ->unique()
            ->sort()
            ->values()
            ->toArray();

        $positionFilters = $allLecturersForFilters
            ->pluck('academic_position')
            ->filter(function ($value) {
                $value = trim($value ?? '');
                if (empty($value) || $value === '-' || preg_match('/[0-9]{5,}/', $value) || str_contains(strtolower($value), '90i3') || strlen($value) > 50) {
                    return false;
                }
                return true;
            })
            ->unique()
            ->sort()
            ->values()
            ->toArray();

        $programFilters = Schema::hasTable('study_programs')
            ? DB::table('study_programs')->pluck('name')->filter()->unique()->sort()->values()->toArray()
            : [];

        // Build the filtered query
        $query = DB::table('lecturers')
            ->leftJoin('study_programs', 'lecturers.study_program_id', '=', 'study_programs.id')
            ->select([
                'lecturers.id',
                'lecturers.name',
                'lecturers.slug',
                'lecturers.gender',
                'lecturers.highest_education',
                'lecturers.academic_position',
                'lecturers.activity_status',
                'study_programs.name as study_program_name'
            ])
            ->where(function($q) {
                // Filter out junk lecturers
                $q->whereNull('lecturers.highest_education')
                  ->orWhere('lecturers.highest_education', 'not like', '%oakw%');
            })
            ->where(function($q) {
                // Filter out junk lecturers
                $q->whereNull('lecturers.academic_position')
                  ->orWhere('lecturers.academic_position', 'not like', '%90i3%');
            });

        // Search Filter
        if ($search = request('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('lecturers.name', 'like', '%' . $search . '%')
                  ->orWhere('lecturers.highest_education', 'like', '%' . $search . '%')
                  ->orWhere('lecturers.academic_position', 'like', '%' . $search . '%');
            });
        }

        // Program Studi Filter
        if ($selectedPrograms = request('program')) {
            if (is_array($selectedPrograms) && count($selectedPrograms) > 0) {
                $query->whereIn('study_programs.name', $selectedPrograms);
            }
        }

        // Pendidikan Terakhir Filter
        if ($selectedEducations = request('education')) {
            if (is_array($selectedEducations) && count($selectedEducations) > 0) {
                $query->whereIn('lecturers.highest_education', $selectedEducations);
            }
        }

        // Jabatan Fungsional Filter
        if ($selectedPositions = request('position')) {
            if (is_array($selectedPositions) && count($selectedPositions) > 0) {
                $query->whereIn('lecturers.academic_position', $selectedPositions);
            }
        }

        $lecturersData = $query->orderBy('lecturers.name')->get();

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
                    'expertise' => '-',
                ];
            })
            ->toArray();

        return view('pages.profil-dosen', [
            'lecturers' => $lecturers,
            'filters' => [
                'program' => $programFilters,
                'education' => $educationFilters,
                'position' => $positionFilters,
            ],
            'selected' => [
                'search' => request('search', ''),
                'program' => (array) request('program', []),
                'education' => (array) request('education', []),
                'position' => (array) request('position', []),
            ]
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
     * Halaman Utama Arsip
     */
    public function arsip(): View
    {
        return view('pages.arsip');
    }

    /**
     * Halaman Arsip Berita
     */
    public function arsipBerita(): View
    {
        return view('pages.arsip-berita');
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

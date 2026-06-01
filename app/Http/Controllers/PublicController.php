<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\View\View;
use App\Http\Controllers\Api\LecturerApiController;
use App\Http\Controllers\Api\PostApiController;
use App\Http\Controllers\Api\StudyProgramApiController;
use App\Http\Controllers\Api\PageApiController;

class PublicController extends Controller
{
    private const PLACEHOLDER_IMAGE = 'https://placehold.co/600x400?text=JTK+POLBAN';

    private const POLBAN_KALENDER_URL = 'https://www.polban.ac.id/tentang-polban/kalender-akademik/';
    private const POLBAN_PERATURAN_AKADEMIK_URL = 'https://www.polban.ac.id/peraturan-akademik/';
    private const LAM_INFOKOM_URL = 'https://laminfokom.or.id/official/data-akreditasi-1.html';
    private const D3_CERTIFICATE_URL = 'https://www.polban.ac.id/wp-content/uploads/2024/01/24.-Sertifikat-Akreditasi-D3-Teknik-Informatika_073-2023-2028.pdf';
    private const D4_CERTIFICATE_URL = 'https://www.polban.ac.id/wp-content/uploads/2025/08/file_sertifikat_25051520395200500455301_1755423415.pdf';

    public function home(): View
    {
        // Ambil Program Studi dari REST API secara internal
        $programsResponse = app(StudyProgramApiController::class)->index(request());
        $programsData = $programsResponse->resolve();

        $programs = collect($programsData)->map(function ($program) {
            return [
                'title' => ($program['degree'] ? $program['degree'] . ' ' : '') . $program['name'],
                'icon' => $program['degree'] === 'D3' ? '💻' : '🎓',
                'accreditation' => 'UNGGUL',
                'description' => $program['description'] ?? 'Program studi unggulan Jurusan Teknik Komputer dan Informatika.',
            ];
        })->toArray();

        return view('pages.home', [
            'latestNews' => $this->getLatestNewsForHome(),
            'programs' => $programs,
        ]);
    }

    public function programStudi(): View
    {
        return view('pages.program-studi', [
            'page' => $this->getPageBySlug('program-studi'),
        ]);
    }

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

    public function profilDosen(): View
    {
        if (!Schema::hasTable('lecturers')) {
            return view('pages.profil-dosen', [
                'lecturers' => [],
                'filters' => $this->emptyLecturerFilters(),
            ]);
        }

        // Memanggil REST API secara internal
        $response = app(LecturerApiController::class)->index(request());
        $data = $response->getData(true);
        $lecturersData = $data['data'] ?? [];

        $lecturers = collect($lecturersData)->map(function ($item) {
            return [
                'id' => $item['slug'] ?? $item['id'],
                'name' => $item['name'] ?? '-',
                'initials' => $this->getInitials($item['name'] ?? '-'),
                'gender' => $item['gender'] ?? '-',
                'position' => $item['highest_education'] ?? '-',
                'functional' => $item['academic_position'] ?? '-',
                'status' => $item['activity_status'] ?? '-',
                'expertise' => collect($item['expertise_areas'] ?? [])->pluck('name')->implode(', ') ?: '-',
            ];
        })->toArray();

        $educationFilters = collect($lecturersData)
            ->pluck('highest_education')
            ->filter()
            ->unique()
            ->sort()
            ->values()
            ->toArray();

        $positionFilters = collect($lecturersData)
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
                'publications' => $portfolioPublications
                    ->merge($scientificPublications)
                    ->filter(fn ($publication) => !empty($publication['title']) && $publication['title'] !== '-')
                    ->take(20)
                    ->values()
                    ->toArray(),
            ],
        ]);
    }

    public function berita(): View
    {
        $category = request('category');
        $search = request('search');
        $news = $this->getPostsForCards(12, $category, $search);

        return view('pages.berita', [
            'news' => $news,
            'categories' => $this->getCategoryNames(),
            'activeCategory' => $category ?: 'Semua Berita',
            'search' => $search ?: '',
            'totalNews' => count($news),
        ]);
    }

    public function detailBerita($id): View
    {
        $post = $this->findPostBySlugOrId($id);

        abort_if(!$post, 404);

        $mediaMap = $this->getMediaMap(collect([$post]));
        $image = $this->getImageForPost($post, $mediaMap);

        $article = [
            'id' => $post->slug ?? $post->id,
            'title' => $this->cleanText($post->title ?? 'Tanpa Judul', 160),
            'date' => $this->formatPostDate($post->published_at ?? $post->created_at ?? null),
            'views' => $post->views ?? 0,
            'image' => $image,
            'content' => $this->cleanHtml($post->content ?? $post->excerpt ?? ''),
        ];

        $relatedArticles = collect($this->getPostsForCards(2))
            ->reject(fn ($item) => (string) $item['id'] === (string) $article['id'])
            ->take(2)
            ->values()
            ->toArray();

        return view('pages.detail-berita', [
            'article' => $article,
            'relatedArticles' => $relatedArticles,
        ]);
    }

    public function prestasi(): View
    {
        return view('pages.prestasi', [
            'achievements' => $this->getPostsForCards(9, 'prestasi'),
        ]);
    }

    public function arsipBerita(): View
    {
        return view('pages.arsip-berita', [
            'news' => $this->getPostsForCards(30),
        ]);
    }

    public function arsipPrestasi(): View
    {
        return $this->arsipBerita();
    }

    public function akademik(): View
    {
        $page = $this->getPageBySlug('akademik');

        return view('pages.akademik', [
            'page' => $page,
            'pageSummary' => $this->getPageSummary($page, 'Informasi akademik Jurusan Teknik Komputer dan Informatika Politeknik Negeri Bandung.'),
            'links' => [
                'calendar' => self::POLBAN_KALENDER_URL,
                'rules' => self::POLBAN_PERATURAN_AKADEMIK_URL,
            ],
        ]);
    }

    public function akreditasi(): View
    {
        $page = $this->getPageBySlug('akreditasi');

        return view('pages.akreditasi', [
            'page' => $page,
            'pageSummary' => $this->getPageSummary($page, 'Informasi status akreditasi program studi di lingkungan Jurusan Teknik Komputer dan Informatika.'),
            'accreditations' => $this->getAccreditationData(),
        ]);
    }

    public function tentangJTK(): View
    {
        try {
            $response = app(PageApiController::class)->show('tentang-jtk');
            $pageData = $response->resolve();
        } catch (\Throwable $e) {
            $pageData = [
                'title' => 'Tentang JTK',
                'content' => null,
            ];
        }

        return view('pages.tentang-jtk', [
            'page' => $pageData,
            'pageContent' => $pageData['content'] ?? null,
        ]);
    }

    public function fasilitas(): View
    {
        return view('pages.fasilitas', [
            'page' => $this->getPageBySlug('fasilitas'),
            'pageContent' => $this->getPageContent('fasilitas'),
        ]);
    }

    public function visiMisi(): View
    {
        return view('pages.visi-misi', [
            'page' => $this->getPageBySlug('visi-dan-misi'),
            'pageContent' => $this->getPageContent('visi-dan-misi'),
        ]);
    }

    public function strukturOrganisasi(): View
    {
        return view('pages.struktur-organisasi', [
            'page' => $this->getPageBySlug('struktur-organisasi'),
            'pageContent' => $this->getPageContent('struktur-organisasi'),
        ]);
    }

    public function hasilPenelitian(): View
    {
        return view('pages.hasil-penelitian', [
            'page' => $this->getPageBySlug('hasil-penelitian'),
            'pageContent' => $this->getPageContent('hasil-penelitian'),
        ]);
    }

    public function riwayatSingkat(): View
    {
        return view('pages.riwayat-singkat', [
            'page' => $this->getPageBySlug('riwayat-singkat'),
            'pageContent' => $this->getPageContent('riwayat-singkat'),
        ]);
    }

    public function produk(): View
    {
        return view('pages.produk', [
            'page' => $this->getPageBySlug('produk'),
            'pageContent' => $this->getPageContent('produk'),
        ]);
    }

    public function tenagaKependidikan(): View
    {
        return view('pages.tenaga-kependidikan', [
            'page' => $this->getPageBySlug('tenaga-kependidikan'),
            'pageContent' => $this->getPageContent('tenaga-kependidikan'),
        ]);
    }

    public function reputasi(): View
    {
        return view('pages.reputasi', [
            'page' => $this->getPageBySlug('reputasi'),
            'pageContent' => $this->getPageContent('reputasi'),
        ]);
    }

    public function kompetensiLulusan(): View
    {
        return view('pages.kompetensi-lulusan', [
            'page' => $this->getPageBySlug('kompetensi-lulusan'),
            'pageContent' => $this->getPageContent('kompetensi-lulusan'),
        ]);
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

    private function getLatestNewsForHome(): array
    {
        $request = \Illuminate\Http\Request::create('/api/posts', 'GET', [
            'per_page' => 2,
            'status' => 'publish'
        ]);
        
        $response = app(PostApiController::class)->index($request);
        $postsData = $response->resolve();

        return collect($postsData)->map(function ($post) {
            $slug = $post['slug'] ?? $post['id'];
            $date = $this->formatPostDate($post['published_at'] ?? null);

            return [
                'id' => $slug,
                'title' => $this->cleanText($post['title'] ?? 'Tanpa Judul', 120),
                'date' => $date,
                'views' => $post['views'] ?? 0,
                'image' => $post['image_url'] ?? self::PLACEHOLDER_IMAGE,
                'excerpt' => $this->cleanText($post['excerpt'] ?? $post['content'] ?? '', 180),
            ];
        })->toArray();
    }

    private function getPostsForCards(int $limit = 12, ?string $categoryKeyword = null, ?string $search = null): array
    {
        $query = $this->basePostsQuery();

        $normalizedCategory = $this->normalizeCategoryKeyword($categoryKeyword);

        if ($normalizedCategory === 'prestasi') {
            $this->applyKeywordGroup($query, ['prestasi', 'juara', 'kompetisi', 'lomba', 'hackathon', 'kmipn']);
        } elseif ($normalizedCategory === 'headline') {
            $this->applyKeywordGroup($query, ['headline']);
        }

        $search = trim((string) $search);

        if ($search !== '') {
            $this->applyKeywordGroup($query, [$search]);
        }

        $posts = $query
            ->limit($limit)
            ->get();

        $mediaMap = $this->getMediaMap($posts);

        return $posts
            ->map(fn ($post) => $this->mapPostToNewsItem($post, $mediaMap))
            ->values()
            ->toArray();
    }

    private function basePostsQuery()
    {
        return DB::table('posts')
            ->where(function ($statusQuery) {
                $statusQuery
                    ->where('status', 'publish')
                    ->orWhere('status', 'published')
                    ->orWhere('status', 'Published')
                    ->orWhere('status', 'PUBLISHED');
            })
            ->orderByDesc('published_at');
    }

    private function applyKeywordGroup($query, array $keywords): void
    {
        $query->where(function ($keywordQuery) use ($keywords) {
            foreach ($keywords as $keyword) {
                $keyword = Str::lower(trim($keyword));

                if ($keyword === '') {
                    continue;
                }

                $like = '%' . $keyword . '%';

                $keywordQuery
                    ->orWhereRaw('LOWER(COALESCE(title, \'\')) LIKE ?', [$like])
                    ->orWhereRaw('LOWER(COALESCE(slug, \'\')) LIKE ?', [$like])
                    ->orWhereRaw('LOWER(COALESCE(excerpt, \'\')) LIKE ?', [$like])
                    ->orWhereRaw('LOWER(COALESCE(content, \'\')) LIKE ?', [$like]);
            }
        });
    }

    private function normalizeCategoryKeyword(?string $categoryKeyword): ?string
    {
        $categoryKeyword = Str::lower(trim((string) $categoryKeyword));

        if ($categoryKeyword === '' || Str::contains($categoryKeyword, 'semua')) {
            return null;
        }

        if (Str::contains($categoryKeyword, 'prestasi')) {
            return 'prestasi';
        }

        if (Str::contains($categoryKeyword, 'headline')) {
            return 'headline';
        }

        return 'berita';
    }

    private function getMediaMap($posts)
    {
        $mediaIds = collect($posts)
            ->pluck('featured_media_id')
            ->filter()
            ->unique()
            ->values();

        if ($mediaIds->isEmpty()) {
            return collect();
        }

        return DB::table('media')
            ->whereIn('id', $mediaIds)
            ->get()
            ->keyBy('id');
    }

    private function mapPostToNewsItem(object $post, $mediaMap): array
    {
        $type = $this->detectPostType($post);

        return [
            'id' => $post->slug ?? $post->id,
            'title' => $this->cleanText($post->title ?? 'Tanpa Judul', 120),
            'category' => $type === 'prestasi' ? 'Prestasi Mahasiswa' : 'Berita',
            'date' => $this->formatPostDate($post->published_at ?? $post->created_at ?? null),
            'views' => $post->views ?? 0,
            'image' => $this->getImageForPost($post, $mediaMap),
            'excerpt' => $this->cleanText($post->excerpt ?? $post->content ?? '', 180),
            'type' => $type,
        ];
    }

    private function findPostBySlugOrId($id): ?object
    {
        return DB::table('posts')
            ->where(function ($query) use ($id) {
                $query->where('slug', $id);

                if (is_numeric($id)) {
                    $query->orWhere('id', $id);
                }
            })
            ->first();
    }

    private function getCategoryNames(): array
    {
        $defaults = ['Semua Berita', 'Berita', 'Prestasi Mahasiswa'];

        if (!Schema::hasTable('categories')) {
            return $defaults;
        }

        $categories = DB::table('categories')
            ->orderBy('name')
            ->pluck('name')
            ->filter()
            ->values()
            ->toArray();

        return array_values(array_unique(array_merge($defaults, $categories)));
    }

    private function getImageForPost(object $post, $mediaMap): string
    {
        if (empty($post->featured_media_id)) {
            return self::PLACEHOLDER_IMAGE;
        }

        $media = $mediaMap->get($post->featured_media_id);

        if (!$media) {
            return self::PLACEHOLDER_IMAGE;
        }

        foreach (['source_url', 'url', 'file_url', 'path', 'file_path', 'disk_path'] as $column) {
            if (isset($media->{$column}) && !empty($media->{$column})) {
                return $this->normalizeMediaUrl((string) $media->{$column});
            }
        }

        return self::PLACEHOLDER_IMAGE;
    }

    private function normalizeMediaUrl(string $url): string
    {
        $url = trim($url);

        if ($url === '') {
            return self::PLACEHOLDER_IMAGE;
        }

        if (Str::startsWith($url, ['http://', 'https://'])) {
            return $url;
        }

        if (Str::startsWith($url, '/')) {
            return 'https://jtk.polban.ac.id' . $url;
        }

        return asset('storage/' . ltrim($url, '/'));
    }

    private function detectPostType(object $post): string
    {
        $haystack = $this->postHaystack($post);

        return Str::contains($haystack, ['prestasi', 'juara', 'kompetisi', 'lomba', 'hackathon', 'kmipn'])
            ? 'prestasi'
            : 'berita';
    }

    private function postHaystack(object $post): string
    {
        return Str::lower($this->cleanText(implode(' ', array_filter([
            $post->title ?? null,
            $post->slug ?? null,
            $post->excerpt ?? null,
            $post->content ?? null,
        ])), 5000));
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

    private function getPageSummary(?object $page, string $fallback): string
    {
        if (!$page) {
            return $fallback;
        }

        $content = $page->excerpt ?? $page->content ?? $page->body ?? '';
        $summary = $this->cleanText($content, 260);

        return $summary !== '' ? $summary : $fallback;
    }

    private function getAccreditationData(): array
    {
        return [
            [
                'program' => 'D3 Teknik Informatika',
                'status' => 'UNGGUL',
                'date' => 'Terakreditasi tahun 2023, berlaku hingga 2028-08-07',
                'noSk' => 'No. SK: 073/SK/LAM-INFOKOM/Ak/D3/VIII/2023',
                'certificate' => 'Sertifikat Akreditasi D3 Teknik Informatika.',
                'certificateUrl' => self::D3_CERTIFICATE_URL,
                'lamUrl' => self::LAM_INFOKOM_URL,
            ],
            [
                'program' => 'Sarjana Terapan Teknik Informatika',
                'status' => 'UNGGUL',
                'date' => 'Terakreditasi tahun 2025, berlaku hingga 2030-08-15',
                'noSk' => 'No. SK: 146/SK/LAM-INFOKOM/Ak/STr/VIII/2025',
                'certificate' => 'Sertifikat Akreditasi Sarjana Terapan Teknik Informatika.',
                'certificateUrl' => self::D4_CERTIFICATE_URL,
                'lamUrl' => self::LAM_INFOKOM_URL,
            ],
        ];
    }

    private function cleanText(?string $text, int $limit = 180): string
    {
        if (!$text) {
            return '';
        }

        $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $text = strip_tags($text);
        $text = trim(preg_replace('/\s+/', ' ', $text));

        return Str::limit($text, $limit);
    }

    private function cleanHtml(?string $html): string
    {
        if (!$html) {
            return '';
        }

        $html = html_entity_decode($html, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        return strip_tags($html, '<p><br><strong><b><em><i><u><ul><ol><li><h1><h2><h3><h4><a><blockquote><span>');
    }

    private function formatPostDate($date): string
    {
        if (!$date) {
            return '-';
        }

        try {
            return Carbon::parse($date)->format('d M Y');
        } catch (\Throwable $e) {
            return (string) $date;
        }
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
            ->map(fn ($part) => strtoupper(substr($part, 0, 1)))
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

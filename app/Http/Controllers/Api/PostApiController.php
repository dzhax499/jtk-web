<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostApiController extends Controller
{
    /**
     * GET /api/posts
     *
     * Query opsional:
     * - ?search=kata
     * - ?type=prestasi atau ?type=berita
     * - ?category=prestasi atau ?category=berita
     * - ?status=publish, ?status=published, atau ?status=all
     * - ?per_page=12
     *
     * Dipakai oleh Blade halaman:
     * - /berita
     * - /prestasi
     */
    public function index(Request $request)
    {
        $perPage = min(max($request->integer('per_page', 12), 1), 30);
        $status = Str::lower((string) $request->query('status', 'publish'));
        $type = Str::lower((string) ($request->query('type') ?: $request->query('category')));
        $search = trim((string) $request->query('search', ''));

        $posts = Post::query()
            ->with(['author', 'featuredMedia'])
            ->when($status !== 'all', function ($query) use ($status) {
                $allowed = $status === 'published'
                    ? ['publish', 'published', 'Published', 'PUBLISHED']
                    : [$status, Str::title($status), Str::upper($status)];

                $query->whereIn('status', array_unique($allowed));
            })
            ->when($search !== '', function ($query) use ($search) {
                $this->applyKeywordSearch($query, $search);
            })
            ->when(in_array($type, ['prestasi', 'achievement', 'achievements'], true), function ($query) {
                $query->where(function ($subQuery) {
                    foreach (['prestasi', 'juara', 'kompetisi', 'lomba', 'penghargaan', 'hackathon'] as $keyword) {
                        $subQuery->orWhere(function ($keywordQuery) use ($keyword) {
                            $this->applyKeywordSearch($keywordQuery, $keyword);
                        });
                    }
                });
            })
            ->when(in_array($type, ['berita', 'news'], true), function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery
                        ->whereRaw('LOWER(COALESCE(title, ?)) NOT LIKE ?', ['', '%prestasi%'])
                        ->whereRaw('LOWER(COALESCE(slug, ?)) NOT LIKE ?', ['', '%prestasi%']);
                });
            })
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->paginate($perPage)
            ->appends($request->query());

        return PostResource::collection($posts)->additional([
            'meta' => [
                'available_filters' => [
                    'search',
                    'type=berita',
                    'type=prestasi',
                    'category=berita',
                    'category=prestasi',
                    'status=publish',
                    'status=all',
                    'per_page',
                ],
                'usage' => [
                    'berita' => '/api/posts',
                    'prestasi' => '/api/posts?type=prestasi',
                    'detail' => '/api/posts/{slug}',
                ],
            ],
        ]);
    }

    /**
     * GET /api/posts/{slug}
     *
     * Dipakai oleh Blade halaman /berita/{slug}.
     */
    public function show(string $slug)
    {
        $post = Post::query()
            ->with(['author', 'featuredMedia'])
            ->where(function ($query) use ($slug) {
                $query->where('slug', $slug);

                if (is_numeric($slug)) {
                    $query->orWhere('id', $slug);
                }
            })
            ->firstOrFail();

        return new PostResource($post);
    }

    private function applyKeywordSearch($query, string $keyword): void
    {
        $keyword = Str::lower($keyword);
        $like = "%{$keyword}%";

        $query->where(function ($subQuery) use ($like) {
            $subQuery
                ->orWhereRaw('LOWER(COALESCE(title, ?)) LIKE ?', ['', $like])
                ->orWhereRaw('LOWER(COALESCE(slug, ?)) LIKE ?', ['', $like])
                ->orWhereRaw('LOWER(COALESCE(excerpt, ?)) LIKE ?', ['', $like])
                ->orWhereRaw('LOWER(COALESCE(content, ?)) LIKE ?', ['', $like]);
        });
    }
}

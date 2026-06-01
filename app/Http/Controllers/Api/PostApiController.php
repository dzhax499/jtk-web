<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
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
     * - ?status=publish, ?status=all
     * - ?per_page=10
     */
    public function index(Request $request)
    {
        $perPage = min(max($request->integer('per_page', 10), 1), 50);
        $status = (string) $request->query('status', 'publish');
        $type = Str::lower((string) ($request->query('type') ?: $request->query('category')));
        $search = trim((string) $request->query('search', ''));

        $posts = Post::query()->with(['author', 'featuredMedia']);

        if ($status !== '' && $status !== 'all' && Schema::hasColumn('posts', 'status')) {
            $posts->where('status', $status);
        }

        if ($search !== '') {
            $this->applyKeywordSearch($posts, $search);
        }

        if (in_array($type, ['prestasi', 'achievement', 'achievements'], true)) {
            $this->applyKeywordSearch($posts, 'prestasi');
        }

        $orderColumn = Schema::hasColumn('posts', 'published_at') ? 'published_at' : 'created_at';

        $posts = $posts
            ->orderByDesc($orderColumn)
            ->paginate($perPage)
            ->appends($request->query());

        return PostResource::collection($posts)->additional([
            'meta' => [
                'available_filters' => [
                    'search',
                    'type=prestasi',
                    'category=prestasi',
                    'status=publish',
                    'status=all',
                    'per_page',
                ],
                'scope' => [
                    'berita' => 'GET /api/posts',
                    'prestasi' => 'GET /api/posts?type=prestasi',
                ],
            ],
        ]);
    }

    /**
     * GET /api/posts/{slug}
     * Param bisa slug, dan fallback numeric ID tetap didukung.
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

        $query->where(function ($subQuery) use ($keyword) {
            foreach ($this->searchablePostColumns() as $column) {
                $subQuery->orWhereRaw("LOWER(COALESCE({$column}, '')) LIKE ?", ["%{$keyword}%"]);
            }
        });
    }

    private function searchablePostColumns(): array
    {
        return collect(['title', 'slug', 'excerpt', 'content'])
            ->filter(fn ($column) => Schema::hasColumn('posts', $column))
            ->values()
            ->toArray();
    }
}

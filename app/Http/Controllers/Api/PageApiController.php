<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\PageResource;
use App\Models\Page;
use Illuminate\Http\Request;

class PageApiController extends Controller
{
    public function index(Request $request)
    {
        $pages = Page::query()
            ->with(['author', 'parent', 'featuredMedia'])
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')))
            ->when(! $request->filled('status'), fn ($query) => $query->where('status', 'publish'))
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = (string) $request->string('search');
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('title', 'like', "%{$search}%")
                        ->orWhere('slug', 'like', "%{$search}%")
                        ->orWhere('excerpt', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('published_at')
            ->paginate($request->integer('per_page', 10));

        return PageResource::collection($pages);
    }

    public function show(string $slug)
    {
        $page = Page::query()
            ->with(['author', 'parent', 'children', 'featuredMedia'])
            ->where('slug', $slug)
            ->where('status', 'publish')
            ->firstOrFail();

        return new PageResource($page);
    }
}

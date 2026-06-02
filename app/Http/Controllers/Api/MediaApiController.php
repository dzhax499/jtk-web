<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\MediaResource;
use App\Models\Media;
use Illuminate\Http\Request;

class MediaApiController extends Controller
{
    public function index(Request $request)
    {
        $media = Media::query()
            ->with('author')
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = (string) $request->string('search');
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('title', 'like', "%{$search}%")
                        ->orWhere('slug', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate($request->integer('per_page', 10));

        return MediaResource::collection($media);
    }
}

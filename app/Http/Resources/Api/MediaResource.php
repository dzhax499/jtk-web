<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $sourceUrl = $this->source_url;

        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'source_url' => $sourceUrl,
            'url' => $sourceUrl
                ? (Str::startsWith($sourceUrl, ['http://', 'https://']) ? $sourceUrl : Storage::url($sourceUrl))
                : null,
            'author' => $this->whenLoaded('author', fn () => $this->author ? [
                'id' => $this->author->id,
                'name' => $this->author->name,
            ] : null),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

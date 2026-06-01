<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $imageUrl = null;

        if ($this->relationLoaded('featuredMedia') && $this->featuredMedia) {
            $sourceUrl = $this->featuredMedia->source_url;

            $imageUrl = $sourceUrl
                ? (Str::startsWith($sourceUrl, ['http://', 'https://']) ? $sourceUrl : Storage::url($sourceUrl))
                : null;
        }

        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'excerpt' => $this->excerpt,
            'status' => $this->status,
            'published_at' => $this->published_at,

            // Karena tabel posts saat ini belum punya category_id,
            // kategori/type diturunkan sederhana dari isi konten untuk kebutuhan Berita/Prestasi.
            'type' => $this->detectType(),
            'category' => $this->detectType() === 'prestasi' ? 'Prestasi' : 'Berita',

            'author' => $this->whenLoaded('author', fn () => $this->author ? [
                'id' => $this->author->id,
                'name' => $this->author->name,
            ] : null),

            'featured_media' => $this->whenLoaded('featuredMedia', fn () => $this->featuredMedia ? [
                'id' => $this->featuredMedia->id,
                'title' => $this->featuredMedia->title,
                'slug' => $this->featuredMedia->slug,
                'source_url' => $this->featuredMedia->source_url,
                'url' => $imageUrl,
            ] : null),

            'image_url' => $imageUrl,
            'api_url' => url('/api/posts/' . $this->slug),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    private function detectType(): string
    {
        $haystack = Str::lower(implode(' ', array_filter([
            $this->title,
            $this->slug,
            $this->excerpt,
            strip_tags((string) $this->content),
        ])));

        return Str::contains($haystack, 'prestasi') ? 'prestasi' : 'berita';
    }
}

<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostResource extends JsonResource
{
    private const PLACEHOLDER_IMAGE = 'https://placehold.co/600x400?text=JTK+POLBAN';

    public function toArray(Request $request): array
    {
        $imageUrl = $this->resolveImageUrl();

        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'excerpt' => $this->cleanText($this->excerpt ?: $this->content, 220),
            'status' => $this->status,
            'published_at' => $this->published_at,
            'type' => $this->detectType(),
            'category' => $this->detectType() === 'prestasi' ? 'Prestasi Mahasiswa' : 'Berita',

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
            'api_url' => url('/api/posts/' . ($this->slug ?? $this->id)),
            'web_url' => url('/berita/' . ($this->slug ?? $this->id)),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    private function resolveImageUrl(): string
    {
        if (!($this->relationLoaded('featuredMedia') && $this->featuredMedia)) {
            return self::PLACEHOLDER_IMAGE;
        }

        $sourceUrl = trim((string) $this->featuredMedia->source_url);

        if ($sourceUrl === '') {
            return self::PLACEHOLDER_IMAGE;
        }

        if (Str::startsWith($sourceUrl, ['http://', 'https://'])) {
            return $sourceUrl;
        }

        if (Str::startsWith($sourceUrl, '/')) {
            return 'https://jtk.polban.ac.id' . $sourceUrl;
        }

        return Storage::url($sourceUrl);
    }

    private function detectType(): string
    {
        $haystack = Str::lower($this->cleanText(implode(' ', array_filter([
            $this->title,
            $this->slug,
            $this->excerpt,
            $this->content,
        ])), 5000));

        return Str::contains($haystack, 'prestasi') ? 'prestasi' : 'berita';
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
}

<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $imageUrl = $this->resolveImageUrl();
        $type = $this->detectType();

        return [
            'id' => $this->id,
            'title' => $this->title ?? 'Tanpa Judul',
            'slug' => $this->slug,
            'content' => $this->content,
            'excerpt' => $this->cleanText($this->excerpt ?: $this->content, 190),
            'status' => $this->status,
            'published_at' => $this->published_at,
            'date_label' => $this->formatDate($this->published_at ?? $this->created_at),
            'views' => 0,

            // Karena tabel posts saat ini belum punya category_id,
            // kategori/type diturunkan sederhana dari isi konten untuk kebutuhan Berita/Prestasi.
            'type' => $type,
            'category' => $type === 'prestasi' ? 'Prestasi Mahasiswa' : 'Berita',

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
            'api_url' => url('/api/posts/' . ($this->slug ?: $this->id)),
            'web_url' => url('/berita/' . ($this->slug ?: $this->id)),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    private function formatDate($date): string
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

    private function detectType(): string
    {
        $haystack = Str::lower(implode(' ', array_filter([
            $this->title,
            $this->slug,
            $this->excerpt,
            strip_tags((string) $this->content),
        ])));

        return Str::contains($haystack, ['prestasi', 'juara', 'kompetisi', 'lomba', 'penghargaan', 'hackathon'])
            ? 'prestasi'
            : 'berita';
    }

    private function cleanText(?string $text, int $limit = 190): string
    {
        if (!$text) {
            return '';
        }

        $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $text = strip_tags($text);
        $text = trim(preg_replace('/\s+/', ' ', $text));

        return Str::limit($text, $limit);
    }

    private function resolveImageUrl(): ?string
    {
        if (! $this->relationLoaded('featuredMedia') || ! $this->featuredMedia) {
            return null;
        }

        $sourceUrl = $this->featuredMedia->source_url;

        if (! $sourceUrl) {
            return null;
        }

        return Str::startsWith($sourceUrl, ['http://', 'https://'])
            ? $sourceUrl
            : Storage::url($sourceUrl);
    }
}

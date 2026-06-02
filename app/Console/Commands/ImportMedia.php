<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ImportMedia extends Command
{
    protected $signature = 'import:media';
    protected $description = 'Import data media (gambar) dari media.json ke Supabase';

    public function handle()
    {
        $this->info('Mencari file media.json...');
        $json = File::get(storage_path('app/data_wp/media.json'));
        $media = json_decode($json, true);

        $this->withProgressBar($media, function ($item) {
            DB::table('media')->updateOrInsert(
                ['id' => $item['id']],
                [
                    // Data JSON WP terstruktur dalam objek "rendered"
                    'title' => $item['title']['rendered'] ?? null,
                    'slug' => $item['slug'] ?? null,
                    'source_url' => $item['guid']['rendered'] ?? null,
                    'author_id' => $item['author'] ?? null,
                    // Mengubah format string ISO "T" menjadi format DateTime standar
                    'created_at' => str_replace('T', ' ', $item['date']),
                    'updated_at' => str_replace('T', ' ', $item['modified']),
                ]
            );
        });

        $this->newLine();
        $this->info('Selesai! Seluruh data Media berhasil dipetakan.');
    }
}
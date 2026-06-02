<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ImportPages extends Command
{
    protected $signature = 'import:pages';
    protected $description = 'Import data halaman dari pages.json';

    public function handle()
    {
        $this->info('Menyedot data halaman prodi (pages.json)...');
        $json = File::get(storage_path('app/data_wp/pages.json'));
        $pages = json_decode($json, true);

        $this->withProgressBar($pages, function ($page) {
            DB::table('pages')->updateOrInsert(
                ['id' => $page['id']],
                [
                    'title' => $page['title']['rendered'] ?? null,
                    'slug' => $page['slug'] ?? null,
                    'content' => $page['content']['rendered'] ?? null,
                    'excerpt' => $page['excerpt']['rendered'] ?? null,
                    'status' => $page['status'] ?? 'publish',
                    'parent_id' => $page['parent'] !== 0 ? $page['parent'] : null,
                    'author_id' => $page['author'] ?? null,
                    'featured_media_id' => $page['featured_media'] !== 0 ? $page['featured_media'] : null,
                    'published_at' => str_replace('T', ' ', $page['date']),
                    'created_at' => str_replace('T', ' ', $page['date']),
                    'updated_at' => str_replace('T', ' ', $page['modified']),
                ]
            );
        });

        $this->newLine();
        $this->info('Selesai! Halaman statis JTK berhasil masuk.');
    }
}
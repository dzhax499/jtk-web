<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ImportPosts extends Command
{
    protected $signature = 'import:posts';
    protected $description = 'Import data berita dari posts.json';

    public function handle()
    {
        $this->info('Menyedot data berita (posts.json)...');
        $json = File::get(storage_path('app/data_wp/posts.json'));
        $posts = json_decode($json, true);

        $this->withProgressBar($posts, function (array $post) {
            DB::table('posts')->updateOrInsert(
                ['id' => $post['id']],
                [
                    'title' => $post['title']['rendered'] ?? null,
                    'slug' => $post['slug'] ?? null,
                    'content' => $post['content']['rendered'] ?? null,
                    'excerpt' => $post['excerpt']['rendered'] ?? null,
                    'status' => $post['status'] ?? 'publish',
                    'author_id' => $post['author'] ?? null,
                    'featured_media_id' => $post['featured_media'] !== 0 ? $post['featured_media'] : null,
                    'published_at' => str_replace('T', ' ', $post['date']),
                    'created_at' => str_replace('T', ' ', $post['date']),
                    'updated_at' => str_replace('T', ' ', $post['modified']),
                ]
            );
        });

        $this->newLine();
        $this->info('Selesai! Berita JTK berhasil diamankan.');
    }
}
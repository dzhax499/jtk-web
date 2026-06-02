<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ImportCategories extends Command
{
    // Ini adalah perintah yang nanti kita ketik di terminal
    protected $signature = 'import:categories';
    protected $description = 'Import data kategori dari file categories.json ke database Supabase';

    public function handle()
    {
        $this->info('Mencari file categories.json...');

        $path = storage_path('app/data_wp/categories.json');

        if (!File::exists($path)) {
            $this->error("File tidak ditemukan! Pastikan file ada di: {$path}");
            return;
        }

        $json = File::get($path);
        $categories = json_decode($json, true);

        $this->info('Mulai menginjeksi data ke Supabase...');

        // Membuat loading bar di terminal agar terlihat keren saat proses jalan
        $this->withProgressBar($categories, function ($cat) {
            DB::table('categories')->updateOrInsert(
                ['id' => $cat['id']], // Jika ID sudah ada, dia update. Jika belum, dia insert.
                [
                    'name' => $cat['name'],
                    'slug' => $cat['slug'],
                    // Data JSON WP pakai 'parent', jika 0 berarti tidak punya parent/null
                    'parent_id' => $cat['parent'] !== 0 ? $cat['parent'] : null, 
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        });

        $this->newLine();
        $this->info('Selesai! Seluruh kategori berhasil dipindahkan ke Supabase.');
    }
}
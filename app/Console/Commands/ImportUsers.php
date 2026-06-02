<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ImportUsers extends Command
{
    protected $signature = 'import:users';
    protected $description = 'Import data users dari users.json ke Supabase';

    public function handle()
    {
        $this->info('Mengambil data users.json...');
        $json = File::get(storage_path('app/data_wp/users.json'));
        $users = json_decode($json, true);

        $this->withProgressBar($users, function ($user) {
            DB::table('users')->updateOrInsert(
                ['id' => $user['id']],
                [
                    'name' => $user['name'],
                    // Laravel mewajibkan email, kita buat email default berdasar slug
                    'email' => $user['slug'] . '@jtk.polban.ac.id', 
                    // Password default agar admin nanti bisa login ke sistem baru
                    'password' => bcrypt('password123'), 
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        });

        $this->newLine();
        $this->info('Selesai! Data Users (Admin/Penulis) berhasil diamankan.');
    }
}
<?php

namespace App\Console\Commands;

use Database\Seeders\LecturerBiodataOnlySeeder;
use Database\Seeders\LecturerPortofolioOnlySeeder;
use Database\Seeders\LecturerRiwayatOnlySeeder;
use Database\Seeders\LecturerScholarOnlySeeder;
use Database\Seeders\LecturerScopusOnlySeeder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SyncLecturerData extends Command
{
    protected $signature = 'sync:lecturer-data
        {--dry-run : Simulasi tanpa perubahan database, dibungkus transaction rollback}
        {--only=* : Jalankan seeder tertentu saja (biodata|riwayat|portofolio|scholar|scopus)}';

    protected $description = 'Jalankan pipeline seeder data dosen secara berurutan';

    private array $seeders = [
        'biodata' => LecturerBiodataOnlySeeder::class,
        'riwayat' => LecturerRiwayatOnlySeeder::class,
        'portofolio' => LecturerPortofolioOnlySeeder::class,
        'scholar' => LecturerScholarOnlySeeder::class,
        'scopus' => LecturerScopusOnlySeeder::class,
    ];

    public function handle(): int
    {
        $only = $this->option('only');
        $isDryRun = $this->option('dry-run');

        if (!empty($only)) {
            $only = array_map('strtolower', $only);
            $invalid = array_diff($only, array_keys($this->seeders));
            if (!empty($invalid)) {
                $this->error('Seeder tidak dikenal: ' . implode(', ', $invalid));
                $this->line('Pilihan: ' . implode(', ', array_keys($this->seeders)));

                return 1;
            }
        }

        $toRun = empty($only) ? array_keys($this->seeders) : $only;

        $this->info('Memulai sinkronisasi data dosen...');
        if ($isDryRun) {
            $this->warn('Mode DRY RUN — tidak ada perubahan yang akan disimpan.');
        }
        $this->line('');

        DB::beginTransaction();
        try {
            foreach ($toRun as $key) {
                $class = $this->seeders[$key];
                $this->line("Menjalankan: {$class}");

                $seeder = app($class);
                $seeder->setContainer(app());
                $seeder->setCommand($this);
                $seeder->__invoke();

                $this->line('');
            }

            if ($isDryRun) {
                DB::rollBack();
                $this->warn('── DRY RUN selesai — tidak ada perubahan yang disimpan ──');
            } else {
                DB::commit();
                $this->info('Semua seeder berhasil dijalankan dan disimpan.');
            }
        } catch (\Throwable $e) {
            DB::rollBack();
            $this->error("Pipeline gagal: {$e->getMessage()}");

            return 1;
        }

        return 0;
    }
}

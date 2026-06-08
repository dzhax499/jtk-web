<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Process;

class ScrapePddikti extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:pddikti
        {--python=python3 : Path ke Python executable}
        {--keyword=Politeknik Negeri Bandung Teknik Informatika : Keyword pencarian dosen}
        {--delay=1.5 : Delay antar request ke PDDIKTI (detik)}
        {--limit=0 : Batasi jumlah dosen yang diproses (0 = semua)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrape data dosen dari PDDIKTI menggunakan library pddiktipy (Python)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $python = $this->option('python');
        $scriptPath = storage_path('app/scripts/scrape_dosen.py');

        // 1. Validasi dependensi
        if (!file_exists($scriptPath)) {
            $this->error("Script tidak ditemukan: {$scriptPath}");
            $this->line('Pastikan file tugas/scrapping-pddikti/scrape_dosen.py sudah di-copy ke storage/app/scripts/');
            return 1;
        }

        $check = Process::run("{$python} -c \"import pddiktipy; print('OK')\"");
        if (!$check->successful()) {
            $this->error('Library pddiktipy belum terinstall.');
            $this->line("Jalankan: {$python} -m pip install pddiktipy pandas");
            return 1;
        }
        $this->info('Dependensi OK. Memulai scraping PDDIKTI...');

        // 2. Jalankan Python script
        $outputDir = storage_path('app/imports/Data_Dosen');
        $env = [
            'PDDIKTI_OUTPUT_DIR' => $outputDir,
            'PDDIKTI_KEYWORD'    => $this->option('keyword'),
            'PDDIKTI_DELAY'      => $this->option('delay'),
        ];

        $result = Process::timeout(900)
            ->env($env)
            ->run("{$python} {$scriptPath}", function (string $type, string $output) {
                $this->output->write($output);
            });

        if (!$result->successful()) {
            $this->error('Scraping PDDIKTI gagal. Exit code: ' . $result->exitCode());
            return 1;
        }

        // 3. Validasi output
        $folders = glob($outputDir . '/*', GLOB_ONLYDIR);
        $this->info('Scraping PDDIKTI selesai. ' . count($folders) . ' folder dosen ditemukan.');

        return 0;
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Process;

class ScrapeScopus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:scopus
        {--python=python3 : Path ke Python executable}
        {--api-key= : Elsevier Scopus API key (opsional)}
        {--no-api : Gunakan HTML scraping tanpa API key}
        {--delay=1.5 : Delay antar request}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrape data publikasi Scopus (Python subprocess)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $python = $this->option('python');
        $scriptPath = storage_path('app/scripts/scopus_scraper.py');

        // 1. Validasi dependensi
        if (!file_exists($scriptPath)) {
            $this->error("Script tidak ditemukan: {$scriptPath}");
            return 1;
        }

        $checkDeps = Process::run("{$python} -c \"import requests, pandas\"");
        if (!$checkDeps->successful()) {
            $this->error('Library dependensi belum terinstall.');
            $this->line("Jalankan: {$python} -m pip install requests pandas tqdm");
            return 1;
        }

        $this->info("Dependensi OK. Memulai scraping Scopus...");

        // 2. Siapkan arguments
        $args = [];
        if ($this->option('api-key')) {
            $args[] = "--api-key=" . escapeshellarg($this->option('api-key'));
        } elseif ($this->option('no-api')) {
            $args[] = "--no-api";
        } else {
            $this->warn("Menjalankan dalam mode --no-api secara otomatis karena API key tidak disediakan.");
            $args[] = "--no-api";
        }

        $argsStr = implode(' ', $args);

        // 3. Jalankan Python script
        $env = [
            'SCOPUS_OUTPUT_DIR' => storage_path('app/imports/scrapping_scopus'),
            'SCOPUS_DELAY'      => $this->option('delay'),
        ];

        $result = Process::timeout(900)
            ->env($env)
            ->run("{$python} {$scriptPath} {$argsStr}", function (string $type, string $output) {
                $this->output->write($output);
            });

        if (!$result->successful()) {
            $this->error('Scraping Scopus gagal. Exit code: ' . $result->exitCode());
            return 1;
        }

        $this->info('Scraping Scopus selesai.');

        return 0;
    }
}

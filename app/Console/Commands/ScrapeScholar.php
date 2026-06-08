<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Process;

class ScrapeScholar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:scholar
        {--python=python3 : Path ke Python executable}
        {--mode=offline : Mode scraping (online|offline)}
        {--start-folder= : Mulai dari folder tertentu (untuk resume)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrape data Scholar (Python subprocess)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $python = $this->option('python');
        $mode = $this->option('mode');
        
        $scriptName = $mode === 'online' ? 'scrape_scholar.py' : 'scrape_scholar_offline.py';
        $scriptPath = storage_path('app/scripts/' . $scriptName);

        // 1. Validasi dependensi
        if (!file_exists($scriptPath)) {
            $this->error("Script tidak ditemukan: {$scriptPath}");
            return 1;
        }

        $checkDeps = $mode === 'online' 
            ? Process::run("{$python} -c \"import scholarly\"")
            : Process::run("{$python} -c \"from bs4 import BeautifulSoup\"");

        if (!$checkDeps->successful()) {
            $this->error('Library dependensi belum terinstall.');
            $this->line("Jalankan: {$python} -m pip install scholarly beautifulsoup4 pandas");
            return 1;
        }
        
        $this->info("Dependensi OK. Memulai scraping Scholar (Mode: {$mode})...");

        // 2. Jalankan Python script
        $env = [
            'SCHOLAR_START_FOLDER' => $this->option('start-folder') ?? '',
            'SCHOLAR_OUTPUT_DIR'   => storage_path('app/imports/Data_Dosen'),
        ];

        // Scholar bisa sangat lama karena rate limit
        $result = Process::timeout(3600)
            ->env($env)
            ->run("{$python} {$scriptPath}", function (string $type, string $output) {
                $this->output->write($output);
            });

        if (!$result->successful()) {
            $this->error('Scraping Scholar gagal. Exit code: ' . $result->exitCode());
            return 1;
        }

        $this->info('Scraping Scholar selesai.');

        return 0;
    }
}

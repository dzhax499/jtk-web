<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Process;

class ScrapeSinta extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:sinta
        {--python=python3 : Path ke Python executable}
        {--output-dir= : Custom output directory}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrape data publikasi SINTA (Python subprocess)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $python = $this->option('python');
        $scriptPath = storage_path('app/scripts/scrape_sinta.py');

        // 1. Validasi dependensi
        if (!file_exists($scriptPath)) {
            $this->error("Script tidak ditemukan: {$scriptPath}");
            return 1;
        }

        $checkDeps = Process::run("{$python} -c \"import requests, bs4, pandas\"");
        if (!$checkDeps->successful()) {
            $this->error('Library dependensi belum terinstall.');
            $this->line("Jalankan: {$python} -m pip install requests beautifulsoup4 pandas");
            return 1;
        }

        $this->info("Dependensi OK. Memulai scraping SINTA...");

        // 2. Jalankan Python script
        $outputDir = $this->option('output-dir') ?? storage_path('app/imports/Data_Dosen');
        $env = [
            'SINTA_OUTPUT_DIR' => $outputDir,
        ];

        $result = Process::timeout(900)
            ->env($env)
            ->run("{$python} {$scriptPath} --output-dir=" . escapeshellarg($outputDir), function (string $type, string $output) {
                $this->output->write($output);
            });

        if (!$result->successful()) {
            $this->error('Scraping SINTA gagal. Exit code: ' . $result->exitCode());
            return 1;
        }

        $this->info('Scraping SINTA selesai.');

        return 0;
    }
}

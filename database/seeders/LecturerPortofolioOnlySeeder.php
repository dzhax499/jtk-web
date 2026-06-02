<?php

namespace Database\Seeders;

use App\Support\LecturerCsvImportHelper;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LecturerPortofolioOnlySeeder extends Seeder
{
    public function run(): void
    {
        $helper = new LecturerCsvImportHelper();
        $folders = $helper->findLecturerFolders();
        $this->command?->info('Import PORTOFOLIO saja. Folder dosen ditemukan: ' . count($folders));

        $processed = 0;
        foreach ($folders as $folder) {
            $lecturerId = $helper->findLecturerIdForFolder($folder);
            if (!$lecturerId) {
                $this->command?->warn('Lewati, lecturer belum ada: ' . basename($folder));
                continue;
            }

            $rows = $helper->readCsvAssoc($folder . DIRECTORY_SEPARATOR . 'portofolio.csv');
            foreach ($rows as $row) {
                $title = $helper->clean($row['judul_kegiatan'] ?? '');
                if ($title === '') {
                    continue;
                }

                $jenis = $helper->nullIfEmpty($row['jenis_kegiatan'] ?? null);
                $category = $helper->nullIfEmpty($row['Kategori_Portofolio'] ?? null);
                $year = $helper->toYear($row['tahun_kegiatan'] ?? null);
                $type = $helper->portfolioType($jenis ?: $category);
                $now = now();

                DB::table('lecturer_portfolio_items')->updateOrInsert(
                    [
                        'lecturer_id' => $lecturerId,
                        'type' => $type,
                        'title' => $title,
                        'year' => $year,
                    ],
                    [
                        'category' => $category ?: $jenis,
                        'description' => null,
                        'source' => 'pddikti_csv',
                        'external_url' => null,
                        'raw_data' => json_encode($row, JSON_UNESCAPED_UNICODE),
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]
                );
            }

            $processed++;
            $this->command?->line('Portofolio diproses: ' . $processed . '/' . count($folders) . ' - ' . basename($folder));
            if ($processed % 5 === 0) {
                DB::disconnect();
                DB::reconnect();
            }
        }

        $this->command?->info('Import portofolio selesai.');
        $helper->printCounts($this->command);
    }
}

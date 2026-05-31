<?php

namespace Database\Seeders;

use App\Support\LecturerCsvImportHelper;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LecturerScholarOnlySeeder extends Seeder
{
    public function run(): void
    {
        $helper = new LecturerCsvImportHelper();
        $folders = $helper->findLecturerFolders();
        $this->command?->info('Import SCHOLAR/PDDIKTI publication. Folder dosen ditemukan: ' . count($folders));

        $processed = 0;
        foreach ($folders as $folder) {
            $lecturerId = $helper->findLecturerIdForFolder($folder);
            if (!$lecturerId) {
                $this->command?->warn('Lewati, lecturer belum ada: ' . basename($folder));
                continue;
            }

            $rows = $helper->readCsvAssoc($folder . DIRECTORY_SEPARATOR . 'scholar.csv');
            foreach ($rows as $row) {
                $title = $helper->clean($row['judul_scholar'] ?? '');
                $matchedTitle = $helper->nullIfEmpty($row['judul_pddikti'] ?? null);
                if ($title === '') {
                    $title = $helper->clean($row['judul_pddikti'] ?? '');
                }
                if ($title === '') {
                    continue;
                }

                $sourceRaw = $helper->clean($row['sumber'] ?? 'scholar');
                $source = Str::slug($sourceRaw !== '' ? $sourceRaw : 'scholar', '_');
                $year = $helper->toYear($row['tahun_scholar'] ?? null);
                $now = now();

                DB::table('lecturer_publications')->updateOrInsert(
                    [
                        'lecturer_id' => $lecturerId,
                        'source' => $source,
                        'title' => $title,
                        'year' => $year,
                    ],
                    [
                        'category' => $helper->nullIfEmpty($row['kategori_pddikti'] ?? null),
                        'matched_title' => $matchedTitle,
                        'citation_count' => $helper->toInt($row['jumlah_sitasi'] ?? null),
                        'venue' => $helper->nullIfEmpty($row['venue'] ?? null),
                        'authors' => $helper->nullIfEmpty($row['authors'] ?? null),
                        'publisher' => $helper->nullIfEmpty($row['publisher'] ?? null),
                        'abstract' => $helper->nullIfEmpty($row['abstract'] ?? null),
                        'publication_url' => $helper->nullIfEmpty($row['pub_url'] ?? null),
                        'eprint_url' => $helper->nullIfEmpty($row['eprint_url'] ?? null),
                        'status' => $helper->nullIfEmpty($row['status'] ?? null),
                        'raw_data' => json_encode($row, JSON_UNESCAPED_UNICODE),
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]
                );
            }

            $processed++;
            $this->command?->line('Scholar diproses: ' . $processed . '/' . count($folders) . ' - ' . basename($folder));
            if ($processed % 5 === 0) {
                DB::disconnect();
                DB::reconnect();
            }
        }

        $this->command?->info('Import scholar selesai.');
        $helper->printCounts($this->command);
    }
}

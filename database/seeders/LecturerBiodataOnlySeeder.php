<?php

namespace Database\Seeders;

use App\Support\LecturerCsvImportHelper;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LecturerBiodataOnlySeeder extends Seeder
{
    public function run(): void
    {
        $helper = new LecturerCsvImportHelper();
        $folders = $helper->findLecturerFolders();
        $this->command?->info('Import BIODATA saja. Folder dosen ditemukan: ' . count($folders));

        $processed = 0;
        foreach ($folders as $folder) {
            $rows = $helper->readCsvAssoc($folder . DIRECTORY_SEPARATOR . 'biodata.csv');
            if (count($rows) === 0) {
                continue;
            }

            $biodata = $rows[0];
            $name = $helper->clean($biodata['nama_dosen'] ?? '');
            if ($name === '') {
                continue;
            }

            $nidn = $helper->extractNidnFromFolder($folder) ?: $helper->findNidnFromRiwayat($folder);
            $studyProgramId = $helper->upsertStudyProgram($biodata);
            $helper->upsertLecturer($biodata, $folder, $studyProgramId, $nidn);

            $processed++;
            $this->command?->line('Biodata diproses: ' . $processed . '/' . count($folders) . ' - ' . basename($folder));

            if ($processed % 10 === 0) {
                DB::disconnect();
                DB::reconnect();
            }
        }

        $this->command?->info('Import biodata selesai.');
        $helper->printCounts($this->command);
    }
}

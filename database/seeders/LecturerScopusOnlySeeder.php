<?php

namespace Database\Seeders;

use App\Support\LecturerCsvImportHelper;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LecturerScopusOnlySeeder extends Seeder
{
    public function run(): void
    {
        $helper = new LecturerCsvImportHelper();
        $paths = $helper->findFilesNamed('scopus_detail_all.csv');

        if (count($paths) === 0) {
            $this->command?->warn('File scopus_detail_all.csv tidak ditemukan. Import Scopus dilewati.');
            return;
        }

        $rows = $helper->readCsvAssoc($paths[0]);
        $this->command?->info('Import SCOPUS. Row ditemukan: ' . count($rows));

        $nameToLecturerId = [];
        $nidnToLecturerId = [];
        foreach (DB::table('lecturers')->select('id', 'name', 'nidn')->get() as $lecturer) {
            $nameToLecturerId[$helper->nameKey($lecturer->name)] = (int) $lecturer->id;
            if ($lecturer->nidn) {
                $nidnToLecturerId[$lecturer->nidn] = (int) $lecturer->id;
            }
        }

        $processed = 0;
        $inserted = 0;
        foreach ($rows as $row) {
            $title = $helper->clean($row['Judul'] ?? '');
            if ($title === '') {
                continue;
            }

            $lecturerId = null;
            $nidn = $helper->normalizeNidn($row['NIDN'] ?? null);
            $nameKey = $helper->nameKey($row['Nama_Dosen'] ?? '');

            if ($nidn !== null && isset($nidnToLecturerId[$nidn])) {
                $lecturerId = $nidnToLecturerId[$nidn];
            } elseif ($nameKey !== '' && isset($nameToLecturerId[$nameKey])) {
                $lecturerId = $nameToLecturerId[$nameKey];
            }

            if ($lecturerId === null) {
                continue;
            }

            $year = $helper->toYear($row['Tahun'] ?? null);
            $now = now();
            DB::table('lecturer_publications')->updateOrInsert(
                [
                    'lecturer_id' => $lecturerId,
                    'source' => 'scopus',
                    'title' => $title,
                    'year' => $year,
                ],
                [
                    'category' => 'Scopus',
                    'matched_title' => null,
                    'citation_count' => $helper->toInt($row['Jumlah_Sitasi'] ?? null),
                    'venue' => $helper->nullIfEmpty($row['Venue_Jurnal'] ?? null),
                    'authors' => $helper->nullIfEmpty($row['Authors'] ?? null),
                    'publication_url' => $helper->nullIfEmpty($row['Link_Scopus'] ?? null),
                    'doi' => $helper->nullIfEmpty($row['DOI'] ?? null),
                    'eid' => $helper->nullIfEmpty($row['EID'] ?? null),
                    'sinta_id' => $helper->nullIfEmpty($row['SINTA_ID'] ?? null),
                    'scopus_author_id' => $helper->nullIfEmpty($row['Scopus_Author_ID'] ?? null),
                    'status' => $helper->nullIfEmpty($row['Status_Detail'] ?? null),
                    'raw_data' => json_encode($row, JSON_UNESCAPED_UNICODE),
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );

            $this->upsertScopusLinks($helper, $lecturerId, $row);
            $inserted++;
            $processed++;

            if ($processed % 25 === 0) {
                $this->command?->line('Scopus diproses: ' . $processed . '/' . count($rows));
                DB::disconnect();
                DB::reconnect();
            }
        }

        $this->command?->info('Import scopus selesai. Publikasi cocok dengan dosen: ' . $inserted);
        $helper->printCounts($this->command);
    }

    private function upsertScopusLinks(LecturerCsvImportHelper $helper, int $lecturerId, array $row): void
    {
        $now = now();
        $sintaId = $helper->nullIfEmpty($row['SINTA_ID'] ?? null);
        $scopusAuthorId = $helper->nullIfEmpty($row['Scopus_Author_ID'] ?? null);

        if ($sintaId !== null) {
            DB::table('lecturer_links')->updateOrInsert(
                [
                    'lecturer_id' => $lecturerId,
                    'platform' => 'sinta',
                    'url' => 'https://sinta.kemdikbud.go.id/authors/profile/' . $sintaId,
                ],
                ['created_at' => $now, 'updated_at' => $now]
            );
        }

        if ($scopusAuthorId !== null) {
            DB::table('lecturer_links')->updateOrInsert(
                [
                    'lecturer_id' => $lecturerId,
                    'platform' => 'scopus',
                    'url' => 'https://www.scopus.com/authid/detail.uri?authorId=' . $scopusAuthorId,
                ],
                ['created_at' => $now, 'updated_at' => $now]
            );
        }
    }
}

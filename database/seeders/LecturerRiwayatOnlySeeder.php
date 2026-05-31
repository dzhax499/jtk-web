<?php

namespace Database\Seeders;

use App\Support\LecturerCsvImportHelper;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LecturerRiwayatOnlySeeder extends Seeder
{
    public function run(): void
    {
        $helper = new LecturerCsvImportHelper();
        $folders = $helper->findLecturerFolders();
        $this->command?->info('Import RIWAYAT pendidikan + mengajar. Folder dosen ditemukan: ' . count($folders));

        $processed = 0;
        foreach ($folders as $folder) {
            $lecturerId = $helper->findLecturerIdForFolder($folder);
            if (!$lecturerId) {
                $this->command?->warn('Lewati, lecturer belum ada: ' . basename($folder));
                continue;
            }
            $studyProgramId = $helper->findStudyProgramIdForLecturer($lecturerId);
            $rows = $helper->readCsvAssoc($folder . DIRECTORY_SEPARATOR . 'riwayat.csv');

            foreach ($rows as $row) {
                $jenis = strtolower($helper->clean($row['Jenis_Riwayat'] ?? ''));
                if ($jenis === 'pendidikan') {
                    $this->upsertEducation($helper, $row, $lecturerId);
                } elseif ($jenis === 'mengajar') {
                    $this->upsertTeaching($helper, $row, $lecturerId, $studyProgramId);
                }
            }

            $processed++;
            $this->command?->line('Riwayat diproses: ' . $processed . '/' . count($folders) . ' - ' . basename($folder));
            if ($processed % 5 === 0) {
                DB::disconnect();
                DB::reconnect();
            }
        }

        $this->command?->info('Import riwayat selesai.');
        $helper->printCounts($this->command);
    }

    private function upsertEducation(LecturerCsvImportHelper $helper, array $row, int $lecturerId): void
    {
        $degree = $helper->nullIfEmpty($row['jenjang'] ?? null);
        $institution = $helper->nullIfEmpty($row['nama_pt'] ?? null);
        $studyProgram = $helper->nullIfEmpty($row['nama_prodi'] ?? null);
        $graduationYear = $helper->toYear($row['tahun_lulus'] ?? null);

        if ($degree === null && $institution === null && $studyProgram === null) {
            return;
        }

        $now = now();
        DB::table('lecturer_educations')->updateOrInsert(
            [
                'lecturer_id' => $lecturerId,
                'degree_level' => $degree,
                'institution_name' => $institution,
                'study_program' => $studyProgram,
                'graduation_year' => $graduationYear,
            ],
            [
                'nidn' => $helper->normalizeNidn($row['nidn'] ?? null),
                'start_year' => $helper->toYear($row['tahun_masuk'] ?? null),
                'academic_degree' => $helper->nullIfEmpty($row['gelar_akademik'] ?? null),
                'degree_abbreviation' => $helper->nullIfEmpty($row['singkatan_gelar'] ?? null),
                'sort_order' => $helper->degreeSortOrder($degree),
                'raw_data' => json_encode($row, JSON_UNESCAPED_UNICODE),
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );
    }

    private function upsertTeaching(LecturerCsvImportHelper $helper, array $row, int $lecturerId, ?int $studyProgramId): void
    {
        $courseName = $helper->clean($row['nama_matkul'] ?? '');
        if ($courseName === '') {
            return;
        }

        $semesterName = $helper->nullIfEmpty($row['nama_semester'] ?? null);
        $now = now();
        DB::table('lecturer_teaching_histories')->updateOrInsert(
            [
                'lecturer_id' => $lecturerId,
                'semester_name' => $semesterName,
                'course_code' => $helper->nullIfEmpty($row['kode_matkul'] ?? null),
                'course_name' => $courseName,
                'class_name' => $helper->nullIfEmpty($row['nama_kelas'] ?? null),
            ],
            [
                'study_program_id' => $studyProgramId,
                'nidn' => $helper->normalizeNidn($row['nidn'] ?? null),
                'academic_year' => $helper->extractAcademicYear($semesterName),
                'is_active' => true,
                'raw_data' => json_encode($row, JSON_UNESCAPED_UNICODE),
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );
    }
}

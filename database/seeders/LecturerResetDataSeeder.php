<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LecturerResetDataSeeder extends Seeder
{
    public function run(): void
    {
        $this->command?->warn('Reset hanya tabel dosen/portofolio. Tabel CMS lama tidak disentuh.');

        DB::statement('TRUNCATE TABLE lecturer_publications, lecturer_teaching_histories, lecturer_educations, lecturer_links, lecturer_portfolio_items, expertise_area_lecturer, expertise_areas, lecturers, study_programs RESTART IDENTITY CASCADE');

        $this->command?->info('Reset data dosen selesai.');
    }
}

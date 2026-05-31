<?php

namespace Database\Seeders;

use App\Models\ExpertiseArea;
use App\Models\Lecturer;
use App\Models\StudyProgram;
use Illuminate\Database\Seeder;

class PortfolioDosenSeeder extends Seeder
{
    public function run(): void
    {
        $d3 = StudyProgram::firstOrCreate(
            ['slug' => 'd3-teknik-informatika'],
            [
                'name' => 'D3 Teknik Informatika',
                'degree' => 'D3',
                'description' => 'Program studi Diploma 3 Teknik Informatika.',
                'is_active' => true,
            ]
        );

        $d4 = StudyProgram::firstOrCreate(
            ['slug' => 'sarjana-terapan-teknik-informatika'],
            [
                'name' => 'Sarjana Terapan Teknik Informatika',
                'degree' => 'D4',
                'description' => 'Program studi Sarjana Terapan Teknik Informatika.',
                'is_active' => true,
            ]
        );

        $rpl = ExpertiseArea::firstOrCreate(
            ['slug' => 'rekayasa-perangkat-lunak'],
            ['name' => 'Rekayasa Perangkat Lunak']
        );

        $ai = ExpertiseArea::firstOrCreate(
            ['slug' => 'artificial-intelligence'],
            ['name' => 'Artificial Intelligence']
        );

        $si = ExpertiseArea::firstOrCreate(
            ['slug' => 'sistem-informasi'],
            ['name' => 'Sistem Informasi']
        );

        $lecturerOne = Lecturer::firstOrCreate(
            ['slug' => 'dosen-contoh-d3'],
            [
                'study_program_id' => $d3->id,
                'name' => 'Dosen Contoh D3',
                'nip' => '197900000000000001',
                'nidn' => '0400000001',
                'email' => 'dosen.d3@example.com',
                'academic_position' => 'Lektor',
                'bio' => 'Contoh data dosen untuk pengujian REST API portofolio dosen.',
                'is_active' => true,
            ]
        );

        $lecturerTwo = Lecturer::firstOrCreate(
            ['slug' => 'dosen-contoh-d4'],
            [
                'study_program_id' => $d4->id,
                'name' => 'Dosen Contoh D4',
                'nip' => '198000000000000002',
                'nidn' => '0400000002',
                'email' => 'dosen.d4@example.com',
                'academic_position' => 'Asisten Ahli',
                'bio' => 'Contoh data dosen Sarjana Terapan untuk pengujian struktur portofolio.',
                'is_active' => true,
            ]
        );

        $lecturerOne->expertiseAreas()->syncWithoutDetaching([$rpl->id, $si->id]);
        $lecturerTwo->expertiseAreas()->syncWithoutDetaching([$rpl->id, $ai->id]);

        $lecturerOne->portfolioItems()->firstOrCreate(
            ['type' => 'research', 'title' => 'Sistem Informasi Akademik Berbasis Web'],
            [
                'description' => 'Contoh item penelitian untuk demo endpoint portofolio dosen.',
                'year' => 2025,
                'source' => 'internal',
                'external_url' => null,
            ]
        );

        $lecturerOne->portfolioItems()->firstOrCreate(
            ['type' => 'community_service', 'title' => 'Pelatihan Pengembangan Website Desa'],
            [
                'description' => 'Contoh kegiatan pengabdian kepada masyarakat.',
                'year' => 2024,
                'source' => 'internal',
                'external_url' => null,
            ]
        );

        $lecturerTwo->portfolioItems()->firstOrCreate(
            ['type' => 'publication', 'title' => 'Implementasi Machine Learning untuk Klasifikasi Data Akademik'],
            [
                'description' => 'Contoh publikasi untuk portofolio dosen.',
                'year' => 2025,
                'source' => 'manual',
                'external_url' => null,
            ]
        );

        $lecturerOne->links()->firstOrCreate(
            ['platform' => 'pddikti'],
            ['url' => 'https://pddikti.kemdiktisaintek.go.id/']
        );

        $lecturerOne->links()->firstOrCreate(
            ['platform' => 'sinta'],
            ['url' => 'https://sinta.kemdiktisaintek.go.id/']
        );
    }
}

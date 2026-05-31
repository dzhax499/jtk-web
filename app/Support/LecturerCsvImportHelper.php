<?php

namespace App\Support;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use FilesystemIterator;

class LecturerCsvImportHelper
{
    public function findLecturerFolders(): array
    {
        $searchRoots = [
            storage_path('app/imports'),
            storage_path('app/import'),
            storage_path('imports'),
            storage_path('import'),
        ];

        $folders = [];

        foreach ($searchRoots as $root) {
            if (!is_dir($root)) {
                continue;
            }

            $iterator = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($root, FilesystemIterator::SKIP_DOTS),
                RecursiveIteratorIterator::SELF_FIRST
            );

            foreach ($iterator as $fileInfo) {
                if (!$fileInfo->isDir()) {
                    continue;
                }

                $path = $fileInfo->getPathname();
                if (is_file($path . DIRECTORY_SEPARATOR . 'biodata.csv')) {
                    $folders[] = $path;
                }
            }
        }

        sort($folders);
        return array_values(array_unique($folders));
    }

    public function findFilesNamed(string $filename): array
    {
        $searchRoots = [
            storage_path('app/imports'),
            storage_path('app/import'),
            storage_path('imports'),
            storage_path('import'),
        ];

        $paths = [];

        foreach ($searchRoots as $root) {
            if (!is_dir($root)) {
                continue;
            }

            $iterator = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($root, FilesystemIterator::SKIP_DOTS)
            );

            foreach ($iterator as $fileInfo) {
                if ($fileInfo->isFile() && strtolower($fileInfo->getFilename()) === strtolower($filename)) {
                    $paths[] = $fileInfo->getPathname();
                }
            }
        }

        sort($paths);
        return array_values(array_unique($paths));
    }

    public function readCsvAssoc(string $path): array
    {
        if (!is_file($path)) {
            return [];
        }

        $handle = fopen($path, 'r');
        if ($handle === false) {
            return [];
        }

        $headers = fgetcsv($handle);
        if ($headers === false) {
            fclose($handle);
            return [];
        }

        $headers = array_map(function ($header) {
            $header = (string) $header;
            $header = preg_replace('/^\xEF\xBB\xBF/', '', $header);
            return trim($header);
        }, $headers);

        $rows = [];
        while (($data = fgetcsv($handle)) !== false) {
            $row = [];
            foreach ($headers as $index => $header) {
                $row[$header] = isset($data[$index]) ? $this->clean($data[$index]) : null;
            }
            $rows[] = $row;
        }

        fclose($handle);
        return $rows;
    }

    public function upsertStudyProgram(array $biodata): ?int
    {
        $name = $this->clean($biodata['nama_prodi'] ?? '');
        if ($name === '') {
            return null;
        }

        $slug = Str::slug($name);
        $now = now();

        $existing = DB::table('study_programs')->where('slug', $slug)->first();
        if ($existing) {
            DB::table('study_programs')->where('id', $existing->id)->update([
                'name' => $name,
                'updated_at' => $now,
            ]);
            return (int) $existing->id;
        }

        return (int) DB::table('study_programs')->insertGetId([
            'name' => $name,
            'slug' => $slug,
            'degree' => null,
            'description' => 'Program studi ' . $name,
            'is_active' => true,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }

    public function upsertLecturer(array $biodata, string $folder, ?int $studyProgramId, ?string $nidn): int
    {
        $name = $this->clean($biodata['nama_dosen'] ?? '');
        $slug = $this->uniqueLecturerSlug($name, $nidn);
        $now = now();

        $payload = [
            'study_program_id' => $studyProgramId,
            'name' => $name,
            'slug' => $slug,
            'nidn' => $nidn,
            'gender' => $this->nullIfEmpty($biodata['jenis_kelamin'] ?? null),
            'employment_status' => $this->nullIfEmpty($biodata['status_ikatan_kerja'] ?? null),
            'activity_status' => $this->nullIfEmpty($biodata['status_aktivitas'] ?? null),
            'academic_position' => $this->nullIfEmpty($biodata['jabatan_akademik'] ?? null),
            'highest_education' => $this->nullIfEmpty($biodata['pendidikan_tertinggi'] ?? null),
            'is_active' => strtolower($this->clean($biodata['status_aktivitas'] ?? '')) !== 'tidak aktif',
            'raw_data' => json_encode([
                'folder' => basename($folder),
                'biodata' => $biodata,
            ], JSON_UNESCAPED_UNICODE),
            'updated_at' => $now,
        ];

        $existing = null;
        if ($nidn !== null && $nidn !== '') {
            $existing = DB::table('lecturers')->where('nidn', $nidn)->first();
        }
        if (!$existing) {
            $existing = DB::table('lecturers')->where('slug', $slug)->first();
        }

        if ($existing) {
            DB::table('lecturers')->where('id', $existing->id)->update($payload);
            return (int) $existing->id;
        }

        $payload['created_at'] = $now;
        return (int) DB::table('lecturers')->insertGetId($payload);
    }

    public function findLecturerIdForFolder(string $folder): ?int
    {
        $biodataPath = $folder . DIRECTORY_SEPARATOR . 'biodata.csv';
        $biodataRows = $this->readCsvAssoc($biodataPath);
        if (count($biodataRows) === 0) {
            return null;
        }

        $biodata = $biodataRows[0];
        $name = $this->clean($biodata['nama_dosen'] ?? '');
        $nidn = $this->extractNidnFromFolder($folder) ?: $this->findNidnFromRiwayat($folder);

        if ($nidn) {
            $lecturer = DB::table('lecturers')->where('nidn', $nidn)->first();
            if ($lecturer) {
                return (int) $lecturer->id;
            }
        }

        if ($name !== '') {
            $slug = Str::slug($name);
            $lecturer = DB::table('lecturers')->where('slug', $slug)->first();
            if ($lecturer) {
                return (int) $lecturer->id;
            }
        }

        return null;
    }

    public function findStudyProgramIdForLecturer(?int $lecturerId): ?int
    {
        if (!$lecturerId) {
            return null;
        }

        $lecturer = DB::table('lecturers')->where('id', $lecturerId)->first();
        return $lecturer?->study_program_id ? (int) $lecturer->study_program_id : null;
    }

    public function extractNidnFromFolder(string $folder): ?string
    {
        $base = basename($folder);
        if (preg_match('/_(\d{8,12})$/', $base, $matches)) {
            return $this->normalizeNidn($matches[1]);
        }
        return null;
    }

    public function findNidnFromRiwayat(string $folder): ?string
    {
        $rows = $this->readCsvAssoc($folder . DIRECTORY_SEPARATOR . 'riwayat.csv');
        foreach ($rows as $row) {
            $nidn = $this->normalizeNidn($row['nidn'] ?? null);
            if ($nidn !== null) {
                return $nidn;
            }
        }
        return null;
    }

    public function normalizeNidn($value): ?string
    {
        $value = $this->clean($value);
        if ($value === '') {
            return null;
        }

        $value = preg_replace('/\.0+$/', '', $value);
        $digits = preg_replace('/\D+/', '', $value);

        if ($digits === '') {
            return null;
        }

        if (strlen($digits) < 10) {
            $digits = str_pad($digits, 10, '0', STR_PAD_LEFT);
        }

        return $digits;
    }

    public function uniqueLecturerSlug(string $name, ?string $nidn): string
    {
        $base = Str::slug($name);
        if ($base === '') {
            $base = 'dosen';
        }

        $existing = DB::table('lecturers')->where('slug', $base)->first();
        if (!$existing) {
            return $base;
        }

        if ($nidn !== null && $existing->nidn === $nidn) {
            return $base;
        }

        if ($nidn !== null) {
            return $base . '-' . $nidn;
        }

        $i = 2;
        while (DB::table('lecturers')->where('slug', $base . '-' . $i)->exists()) {
            $i++;
        }

        return $base . '-' . $i;
    }

    public function nameKey($value): string
    {
        return Str::of($this->clean($value))->lower()->replaceMatches('/[^a-z0-9]+/', '')->toString();
    }

    public function portfolioType(?string $value): string
    {
        $v = strtolower($this->clean($value));

        return match (true) {
            str_contains($v, 'pengabdian') => 'community_service',
            str_contains($v, 'penelitian') => 'research',
            str_contains($v, 'publikasi') => 'publication',
            str_contains($v, 'sertifikasi') => 'certification',
            str_contains($v, 'penghargaan') => 'award',
            str_contains($v, 'project') || str_contains($v, 'proyek') => 'project',
            default => Str::slug($v !== '' ? $v : 'portfolio', '_'),
        };
    }

    public function degreeSortOrder(?string $degree): int
    {
        $degree = strtoupper((string) $degree);
        return match ($degree) {
            'S3' => 1,
            'S2' => 2,
            'S1', 'D4' => 3,
            default => 9,
        };
    }

    public function extractAcademicYear(?string $semesterName): ?string
    {
        if ($semesterName && preg_match('/(\d{4}\s*\/\s*\d{4})/', $semesterName, $matches)) {
            return str_replace(' ', '', $matches[1]);
        }
        return null;
    }

    public function toYear($value): ?int
    {
        $value = $this->clean($value);
        if ($value === '') {
            return null;
        }

        if (preg_match('/(19|20)\d{2}/', $value, $matches)) {
            return (int) $matches[0];
        }

        return null;
    }

    public function toInt($value): int
    {
        $value = $this->clean($value);
        if ($value === '') {
            return 0;
        }
        return (int) preg_replace('/[^0-9-]/', '', $value);
    }

    public function clean($value): string
    {
        if ($value === null) {
            return '';
        }
        $value = (string) $value;
        $value = preg_replace('/^\xEF\xBB\xBF/', '', $value);
        return trim($value);
    }

    public function nullIfEmpty($value): ?string
    {
        $value = $this->clean($value);
        return $value === '' ? null : $value;
    }

    public function printCounts($command = null): void
    {
        $tables = [
            'study_programs',
            'lecturers',
            'lecturer_educations',
            'lecturer_teaching_histories',
            'lecturer_portfolio_items',
            'lecturer_publications',
            'lecturer_links',
        ];

        foreach ($tables as $table) {
            if (DB::getSchemaBuilder()->hasTable($table)) {
                $line = $table . ': ' . DB::table($table)->count();
                if ($command) {
                    $command->line($line);
                }
            }
        }
    }
}

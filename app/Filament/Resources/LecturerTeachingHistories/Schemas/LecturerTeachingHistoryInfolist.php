<?php

namespace App\Filament\Resources\LecturerTeachingHistories\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class LecturerTeachingHistoryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('lecturer.name')
                    ->label('Dosen'),
                TextEntry::make('studyProgram.name')
                    ->label('Program Studi'),
                TextEntry::make('nidn')
                    ->label('NIDN')
                    ->placeholder('-'),
                TextEntry::make('semester_name')
                    ->label('Semester')
                    ->placeholder('-'),
                TextEntry::make('course_code')
                    ->label('Kode Mata Kuliah')
                    ->placeholder('-'),
                TextEntry::make('course_name')
                    ->label('Nama Mata Kuliah'),
                TextEntry::make('class_name')
                    ->label('Kelas')
                    ->placeholder('-'),
                TextEntry::make('academic_year')
                    ->label('Tahun Akademik')
                    ->placeholder('-'),
                IconEntry::make('is_active')
                    ->label('Status Aktif')
                    ->boolean(),
                TextEntry::make('raw_data')
                    ->label('Data Mentah')
                    ->placeholder('-')
                    ->columnSpanFull(),
            ]);
    }
}

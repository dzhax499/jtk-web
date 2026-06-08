<?php

namespace App\Filament\Resources\LecturerTeachingHistories\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class LecturerTeachingHistoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('lecturer_id')
                    ->relationship('lecturer', 'name')
                    ->label('Dosen')
                    ->required()
                    ->searchable()
                    ->preload(),
                Select::make('study_program_id')
                    ->relationship('studyProgram', 'name')
                    ->label('Program Studi')
                    ->searchable()
                    ->preload(),
                TextInput::make('nidn')
                    ->label('NIDN'),
                TextInput::make('semester_name')
                    ->label('Semester')
                    ->required()
                    ->maxLength(255),
                TextInput::make('course_code')
                    ->label('Kode Mata Kuliah')
                    ->required()
                    ->maxLength(255),
                TextInput::make('course_name')
                    ->label('Nama Mata Kuliah')
                    ->required()
                    ->maxLength(255),
                TextInput::make('class_name')
                    ->label('Kelas'),
                TextInput::make('academic_year')
                    ->label('Tahun Akademik'),
                Toggle::make('is_active')
                    ->label('Status Aktif')
                    ->required()
                    ->default(true),
                Textarea::make('raw_data')
                    ->label('Data Mentah')
                    ->disabled()
                    ->columnSpanFull(),
            ]);
    }
}

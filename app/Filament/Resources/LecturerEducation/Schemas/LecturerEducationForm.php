<?php

namespace App\Filament\Resources\LecturerEducation\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LecturerEducationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('lecturer_id')
                    ->relationship('lecturer', 'name')
                    ->label('Dosen')
                    ->searchable()
                    ->required(),
                TextInput::make('nidn')
                    ->label('NIDN'),
                TextInput::make('degree_level')
                    ->label('Jenjang Pendidikan'),
                TextInput::make('institution_name')
                    ->label('Perguruan Tinggi'),
                TextInput::make('study_program')
                    ->label('Program Studi'),
                TextInput::make('start_year')
                    ->label('Tahun Mulai')
                    ->numeric(),
                TextInput::make('graduation_year')
                    ->label('Tahun Lulus')
                    ->numeric(),
                TextInput::make('academic_degree')
                    ->label('Gelar Akademik'),
                TextInput::make('degree_abbreviation')
                    ->label('Singkatan Gelar'),
                TextInput::make('sort_order')
                    ->label('Urutan')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('raw_data')
                    ->label('Data Mentah'),
            ]);
    }
}
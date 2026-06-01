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
                    ->label('Lecturer')
                    ->searchable()
                    ->required(),
                TextInput::make('nidn'),
                TextInput::make('degree_level'),
                TextInput::make('institution_name'),
                TextInput::make('study_program'),
                TextInput::make('start_year')
                    ->numeric(),
                TextInput::make('graduation_year')
                    ->numeric(),
                TextInput::make('academic_degree'),
                TextInput::make('degree_abbreviation'),
                TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('raw_data'),
            ]);
    }
}

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
                    ->label('Lecturer')
                    ->required()
                    ->searchable()
                    ->preload(),
                Select::make('study_program_id')
                    ->relationship('studyProgram', 'name')
                    ->label('Study Program')
                    ->searchable()
                    ->preload(),
                TextInput::make('nidn'),
                TextInput::make('semester_name'),
                TextInput::make('course_code'),
                TextInput::make('course_name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('class_name'),
                TextInput::make('academic_year'),
                Toggle::make('is_active')
                    ->required()
                    ->default(true),
                Textarea::make('raw_data')
                    ->disabled()
                    ->columnSpanFull(),
            ]);
    }
}

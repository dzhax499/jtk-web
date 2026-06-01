<?php

namespace App\Filament\Resources\Lecturers\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class LecturerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('study_program_id')
                    ->relationship('studyProgram', 'name')
                    ->label('Study Program')
                    ->searchable()
                    ->preload(),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                TextInput::make('nip'),
                TextInput::make('nidn'),
                TextInput::make('email')
                    ->label('Email address')
                    ->email(),
                TextInput::make('photo_url')
                    ->url(),
                TextInput::make('academic_position'),
                Textarea::make('bio')
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->required()
                    ->default(true),
                Select::make('gender')
                    ->options([
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    ]),
                TextInput::make('employment_status'),
                TextInput::make('activity_status'),
                TextInput::make('highest_education'),
                TextInput::make('raw_data'),
            ]);
    }
}

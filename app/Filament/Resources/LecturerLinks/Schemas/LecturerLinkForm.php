<?php

namespace App\Filament\Resources\LecturerLinks\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LecturerLinkForm
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
                Select::make('platform')
                    ->required()
                    ->options([
                        'pddikti' => 'PDDIKTI',
                        'sinta' => 'SINTA',
                        'google_scholar' => 'Google Scholar',
                        'scopus' => 'Scopus',
                        'garuda' => 'Garuda',
                        'personal_website' => 'Website Pribadi',
                    ]),
                TextInput::make('url')
                    ->required()
                    ->url()
                    ->maxLength(255),
            ]);
    }
}

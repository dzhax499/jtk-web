<?php

namespace App\Filament\Resources\LecturerPublications\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class LecturerPublicationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('lecturer_id')
                    ->relationship('lecturer', 'name')
                    ->label('Lecturer')
                    ->searchable(),
                TextInput::make('source'),
                TextInput::make('category'),
                Textarea::make('title')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('matched_title')
                    ->columnSpanFull(),
                TextInput::make('year')
                    ->numeric(),
                TextInput::make('citation_count')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('venue'),
                Textarea::make('authors')
                    ->columnSpanFull(),
                TextInput::make('publisher'),
                Textarea::make('abstract')
                    ->columnSpanFull(),
                Textarea::make('publication_url')
                    ->columnSpanFull(),
                Textarea::make('eprint_url')
                    ->columnSpanFull(),
                TextInput::make('doi'),
                TextInput::make('eid'),
                TextInput::make('sinta_id'),
                TextInput::make('scopus_author_id'),
                TextInput::make('status'),
                TextInput::make('raw_data'),
            ]);
    }
}

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
                    ->label('Dosen')
                    ->searchable(),
                TextInput::make('source')
                    ->label('Sumber'),
                TextInput::make('category')
                    ->label('Kategori'),
                Textarea::make('title')
                    ->label('Judul')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('matched_title')
                    ->label('Judul yang Cocok')
                    ->columnSpanFull(),
                TextInput::make('year')
                    ->label('Tahun')
                    ->numeric(),
                TextInput::make('citation_count')
                    ->label('Jumlah Sitasi')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('venue')
                    ->label('Tempat Publikasi'),
                Textarea::make('authors')
                    ->label('Penulis')
                    ->columnSpanFull(),
                TextInput::make('publisher')
                    ->label('Penerbit'),
                Textarea::make('abstract')
                    ->label('Abstrak')
                    ->columnSpanFull(),
                Textarea::make('publication_url')
                    ->label('URL Publikasi')
                    ->columnSpanFull(),
                Textarea::make('eprint_url')
                    ->label('URL Eprint')
                    ->columnSpanFull(),
                TextInput::make('doi')
                    ->label('DOI'),
                TextInput::make('eid')
                    ->label('EID'),
                TextInput::make('sinta_id')
                    ->label('SINTA ID'),
                TextInput::make('scopus_author_id')
                    ->label('Scopus Author ID'),
                TextInput::make('status')
                    ->label('Status'),
                TextInput::make('raw_data')
                    ->label('Data Mentah'),
            ]);
    }
}

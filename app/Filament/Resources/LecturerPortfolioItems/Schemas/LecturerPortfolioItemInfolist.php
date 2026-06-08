<?php

namespace App\Filament\Resources\LecturerPortfolioItems\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class LecturerPortfolioItemInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('lecturer.name')
                    ->label('Dosen'),
                TextEntry::make('type')
                    ->label('Tipe'),
                TextEntry::make('title')
                    ->label('Judul')
                    ->columnSpanFull(),
                TextEntry::make('year')
                    ->label('Tahun')
                    ->placeholder('-'),
                TextEntry::make('category')
                    ->label('Kategori')
                    ->placeholder('-'),
                TextEntry::make('source')
                    ->label('Sumber')
                    ->placeholder('-'),
                TextEntry::make('external_url')
                    ->label('URL Eksternal')
                    ->placeholder('-'),
                TextEntry::make('description')
                    ->label('Deskripsi')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('raw_data')
                    ->label('Data Mentah')
                    ->placeholder('-')
                    ->columnSpanFull(),
            ]);
    }
}

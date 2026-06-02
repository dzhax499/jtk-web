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
                    ->label('Lecturer'),
                TextEntry::make('type'),
                TextEntry::make('title')
                    ->columnSpanFull(),
                TextEntry::make('year')
                    ->placeholder('-'),
                TextEntry::make('category')
                    ->placeholder('-'),
                TextEntry::make('source')
                    ->placeholder('-'),
                TextEntry::make('external_url')
                    ->placeholder('-'),
                TextEntry::make('description')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('raw_data')
                    ->placeholder('-')
                    ->columnSpanFull(),
            ]);
    }
}

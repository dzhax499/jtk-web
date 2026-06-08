<?php

namespace App\Filament\Resources\ExpertiseAreas\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ExpertiseAreaInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label('Nama'),
                TextEntry::make('slug')
                    ->label('Slug'),
            ]);
    }
}
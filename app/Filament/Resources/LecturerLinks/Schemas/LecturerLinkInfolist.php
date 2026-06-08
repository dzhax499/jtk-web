<?php

namespace App\Filament\Resources\LecturerLinks\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class LecturerLinkInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('lecturer.name')
                    ->label('Dosen'),
                TextEntry::make('platform')
                    ->label('Platform'),
                TextEntry::make('url')
                    ->label('Tautan (URL)'),
            ]);
    }
}
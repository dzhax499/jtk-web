<?php

namespace App\Filament\Resources\LecturerPortfolioItems\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class LecturerPortfolioItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('lecturer_id')
                    ->relationship('lecturer', 'name')
                    ->label('Dosen')
                    ->required()
                    ->searchable()
                    ->preload(),
                Select::make('type')
                    ->label('Tipe')
                    ->required()
                    ->options([
                        'research' => 'Research (Penelitian)',
                        'publication' => 'Publication (Publikasi)',
                        'community_service' => 'Community Service (Pengabdian)',
                        'certification' => 'Certification (Sertifikasi)',
                        'award' => 'Award (Penghargaan)',
                        'project' => 'Project (Proyek)',
                    ]),
                Textarea::make('title')
                    ->label('Judul')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('year')
                    ->label('Tahun')
                    ->numeric(),
                TextInput::make('category')
                    ->label('Kategori'),
                TextInput::make('source')
                    ->label('Sumber')
                    ->default('manual admin'),
                TextInput::make('external_url')
                    ->label('URL Eksternal')
                    ->url(),
                Textarea::make('description')
                    ->label('Deskripsi')
                    ->columnSpanFull(),
                Textarea::make('raw_data')
                    ->label('Data Mentah')
                    ->disabled()
                    ->columnSpanFull(),
            ]);
    }
}

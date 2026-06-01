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
                    ->label('Lecturer')
                    ->required()
                    ->searchable()
                    ->preload(),
                Select::make('type')
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
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('year')
                    ->numeric(),
                TextInput::make('category'),
                TextInput::make('source')
                    ->default('manual admin'),
                TextInput::make('external_url')
                    ->url(),
                Textarea::make('description')
                    ->columnSpanFull(),
                Textarea::make('raw_data')
                    ->disabled()
                    ->columnSpanFull(),
            ]);
    }
}

<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('title')
                    ->label('Judul')
                    ->columnSpanFull(),
                TextInput::make('slug')
                    ->label('Slug'),
                Textarea::make('content')
                    ->label('Konten')
                    ->columnSpanFull(),
                Textarea::make('excerpt')
                    ->label('Ringkasan')
                    ->columnSpanFull(),
                TextInput::make('status')
                    ->label('Status')
                    ->required()
                    ->default('publish'),
                TextInput::make('author_id')
                    ->label('ID Penulis')
                    ->numeric(),
                TextInput::make('featured_media_id')
                    ->label('ID Media Utama')
                    ->numeric(),
                DateTimePicker::make('published_at')
                    ->label('Tanggal Publikasi'),
            ]);
    }
}
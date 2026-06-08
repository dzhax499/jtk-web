<?php

namespace App\Filament\Resources\Pages\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                // --- Konten Utama ---
                TextInput::make('title')
                    ->label('Judul Halaman')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $operation, $state, callable $set) =>
                        $operation === 'create' ? $set('slug', Str::slug($state)) : null
                    ),

                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->unique(ignoreRecord: true),

                Textarea::make('excerpt')
                    ->label('Ringkasan')
                    ->rows(3)
                    ->columnSpanFull(),

                Textarea::make('content')
                    ->label('Isi Konten')
                    ->rows(8)
                    ->columnSpanFull(),

                // --- Pengaturan ---
                Select::make('status')
                    ->label('Status')
                    ->required()
                    ->default('publish')
                    ->native(false)
                    ->options([
                        'publish' => 'Publish',
                        'draft'   => 'Draft',
                    ]),

                DateTimePicker::make('published_at')
                    ->label('Tanggal Terbit')
                    ->native(false),

                // --- Relasi ---
                Select::make('parent_id')
                    ->label('Halaman Induk')
                    ->relationship('parent', 'title')
                    ->searchable()
                    ->preload()
                    ->native(false)
                    ->placeholder('Tidak ada (halaman utama)'),

                Select::make('featured_media_id')
                    ->label('Media yang Ditampilkan')
                    ->relationship('featuredMedia', 'title')
                    ->searchable()
                    ->preload()
                    ->native(false)
                    ->placeholder('Tidak ada'),

                // --- Sistem ---
                Hidden::make('author_id')
                    ->default(fn () => auth()->id()),

            ]);
    }
}

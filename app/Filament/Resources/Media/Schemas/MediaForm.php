<?php

namespace App\Filament\Resources\Media\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class MediaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $operation, $state, callable $set) => $operation === 'create' ? $set('slug', \Illuminate\Support\Str::slug($state)) : null),
                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),
                \Filament\Forms\Components\FileUpload::make('source_url')
                    ->directory('media')
                    ->image()
                    ->imageEditor()
                    ->columnSpanFull(),
                \Filament\Forms\Components\Hidden::make('author_id')
                    ->default(fn () => auth()->id()),
            ]);
    }
}

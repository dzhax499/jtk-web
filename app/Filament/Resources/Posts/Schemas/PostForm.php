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
                    ->columnSpanFull(),
                TextInput::make('slug'),
                Textarea::make('content')
                    ->columnSpanFull(),
                Textarea::make('excerpt')
                    ->columnSpanFull(),
                TextInput::make('status')
                    ->required()
                    ->default('publish'),
                TextInput::make('author_id')
                    ->numeric(),
                TextInput::make('featured_media_id')
                    ->numeric(),
                DateTimePicker::make('published_at'),
            ]);
    }
}

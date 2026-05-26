<?php

namespace App\Filament\Resources\Pages\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PageForm
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
                TextInput::make('parent_id')
                    ->numeric(),
                TextInput::make('author_id')
                    ->numeric(),
                TextInput::make('featured_media_id')
                    ->numeric(),
                DateTimePicker::make('published_at'),
            ]);
    }
}

<?php

namespace App\Filament\Resources;

use App\Models\Page;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Illuminate\Support\Str;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-document';
    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('title')
                ->required()
                ->live(onBlur: true)
                ->afterStateUpdated(fn (string $operation, $state, callable $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
            TextInput::make('slug')
                ->required()
                ->unique(ignoreRecord: true),
            RichEditor::make('content')->columnSpanFull(),
            Textarea::make('excerpt')->columnSpanFull(),
            Select::make('parent_id')
                ->relationship('parent', 'title')
                ->label('Parent Page')
                ->searchable(),
            Select::make('status')
                ->options([
                    'draft' => 'Draft',
                    'publish' => 'Publish',
                ])
                ->default('publish'),
            Select::make('featured_media_id')
                ->relationship('featuredMedia', 'title')
                ->searchable(),
            Select::make('author_id')
                ->relationship('author', 'name')
                ->default(fn () => auth()->id())
                ->searchable(),
            DateTimePicker::make('published_at'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('title')->searchable(),
            Tables\Columns\TextColumn::make('parent.title')->label('Parent'),
            Tables\Columns\TextColumn::make('status')
                ->badge()
                ->colors([
                    'primary' => 'publish',
                    'warning' => 'draft',
                ]),
            Tables\Columns\TextColumn::make('author.name')->sortable(),
        ]);
    }
}
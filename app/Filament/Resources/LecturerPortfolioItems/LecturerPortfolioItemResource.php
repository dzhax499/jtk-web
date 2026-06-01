<?php

namespace App\Filament\Resources\LecturerPortfolioItems;

use App\Filament\Resources\LecturerPortfolioItems\Pages\CreateLecturerPortfolioItem;
use App\Filament\Resources\LecturerPortfolioItems\Pages\EditLecturerPortfolioItem;
use App\Filament\Resources\LecturerPortfolioItems\Pages\ListLecturerPortfolioItems;
use App\Filament\Resources\LecturerPortfolioItems\Pages\ViewLecturerPortfolioItem;
use App\Filament\Resources\LecturerPortfolioItems\Schemas\LecturerPortfolioItemForm;
use App\Filament\Resources\LecturerPortfolioItems\Schemas\LecturerPortfolioItemInfolist;
use App\Filament\Resources\LecturerPortfolioItems\Tables\LecturerPortfolioItemsTable;
use App\Models\LecturerPortfolioItem;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LecturerPortfolioItemResource extends Resource
{
    protected static ?string $model = LecturerPortfolioItem::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return LecturerPortfolioItemForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LecturerPortfolioItemInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LecturerPortfolioItemsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLecturerPortfolioItems::route('/'),
            'create' => CreateLecturerPortfolioItem::route('/create'),
            'view' => ViewLecturerPortfolioItem::route('/{record}'),
            'edit' => EditLecturerPortfolioItem::route('/{record}/edit'),
        ];
    }
}

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
        $schema = LecturerPortfolioItemForm::configure($schema);
        $components = array_merge($schema->getComponents() ?? [], \App\Helpers\DynamicFieldsHelper::getFormComponents(self::$model));
        return $schema->components($components);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LecturerPortfolioItemInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        $table = LecturerPortfolioItemsTable::configure($table);
        $columns = array_merge($table->getColumns() ?? [], \App\Helpers\DynamicFieldsHelper::getTableColumns(self::$model));
        return $table->columns($columns);
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

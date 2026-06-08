<?php

namespace App\Filament\Resources\Categories;

use App\Filament\Resources\Categories\Pages\CreateCategory;
use App\Filament\Resources\Categories\Pages\EditCategory;
use App\Filament\Resources\Categories\Pages\ListCategories;
use App\Filament\Resources\Categories\Schemas\CategoryForm;
use App\Filament\Resources\Categories\Tables\CategoriesTable;
use App\Models\Category;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;
    protected static ?string $modelLabel = 'Kategori';
    protected static ?string $pluralModelLabel = 'Kategori';
    protected static ?string $navigationLabel = 'Kategori';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        // 1. Ambil form Kategori yang sudah kamu desain (berbahasa Indonesia)
        $schema = CategoryForm::configure($schema);
        
        // 2. Gabungkan dengan form dinamis buatan Klaster 2
        $components = array_merge(
            $schema->getComponents() ?? [],
            \App\Helpers\DynamicFieldsHelper::getFormComponents(self::$model)
        );
        
        return $schema->components($components);
    }

    public static function table(Table $table): Table
    {
        // 1. Ambil tabel Kategori yang sudah kamu desain (ada tombol Delete di samping Edit)
        $table = CategoriesTable::configure($table);
        
        // 2. Gabungkan dengan kolom dinamis buatan Klaster 2
        $columns = array_merge(
            $table->getColumns() ?? [],
            \App\Helpers\DynamicFieldsHelper::getTableColumns(self::$model)
        );
        
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
            'index' => ListCategories::route('/'),
            'create' => CreateCategory::route('/create'),
            'edit' => EditCategory::route('/{record}/edit'),
        ];
    }
}

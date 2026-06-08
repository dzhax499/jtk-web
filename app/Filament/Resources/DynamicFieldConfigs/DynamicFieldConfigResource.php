<?php

namespace App\Filament\Resources\DynamicFieldConfigs;

use App\Filament\Resources\DynamicFieldConfigs\Pages\CreateDynamicFieldConfig;
use App\Filament\Resources\DynamicFieldConfigs\Pages\EditDynamicFieldConfig;
use App\Filament\Resources\DynamicFieldConfigs\Pages\ListDynamicFieldConfigs;
use App\Filament\Resources\DynamicFieldConfigs\Schemas\DynamicFieldConfigForm;
use App\Filament\Resources\DynamicFieldConfigs\Tables\DynamicFieldConfigsTable;
use App\Models\DynamicFieldConfig;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DynamicFieldConfigResource extends Resource
{
    protected static ?string $model = DynamicFieldConfig::class;
    protected static ?string $modelLabel = 'Kolom Dinamis';
    protected static ?string $pluralModelLabel = 'Kolom Dinamis';
    protected static ?string $navigationLabel = 'Kolom Dinamis';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedWrench;

    public static function form(Schema $schema): Schema
    {
        return DynamicFieldConfigForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DynamicFieldConfigsTable::configure($table);
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
            'index' => ListDynamicFieldConfigs::route('/'),
            'create' => CreateDynamicFieldConfig::route('/create'),
            'edit' => EditDynamicFieldConfig::route('/{record}/edit'),
        ];
    }
}

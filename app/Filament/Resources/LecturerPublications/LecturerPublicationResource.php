<?php

namespace App\Filament\Resources\LecturerPublications;

use App\Filament\Resources\LecturerPublications\Pages\CreateLecturerPublication;
use App\Filament\Resources\LecturerPublications\Pages\EditLecturerPublication;
use App\Filament\Resources\LecturerPublications\Pages\ListLecturerPublications;
use App\Filament\Resources\LecturerPublications\Schemas\LecturerPublicationForm;
use App\Filament\Resources\LecturerPublications\Tables\LecturerPublicationsTable;
use App\Models\LecturerPublication;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LecturerPublicationResource extends Resource
{
    protected static ?string $model = LecturerPublication::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        $schema = LecturerPublicationForm::configure($schema);
        $components = array_merge($schema->getComponents() ?? [], \App\Helpers\DynamicFieldsHelper::getFormComponents(self::$model));
        return $schema->components($components);
    }

    public static function table(Table $table): Table
    {
        $table = LecturerPublicationsTable::configure($table);
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
            'index' => ListLecturerPublications::route('/'),
            'create' => CreateLecturerPublication::route('/create'),
            'edit' => EditLecturerPublication::route('/{record}/edit'),
        ];
    }
}

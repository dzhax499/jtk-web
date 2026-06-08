<?php

namespace App\Filament\Resources\LecturerEducation;

use App\Filament\Resources\LecturerEducation\Pages\CreateLecturerEducation;
use App\Filament\Resources\LecturerEducation\Pages\EditLecturerEducation;
use App\Filament\Resources\LecturerEducation\Pages\ListLecturerEducation;
use App\Filament\Resources\LecturerEducation\Schemas\LecturerEducationForm;
use App\Filament\Resources\LecturerEducation\Tables\LecturerEducationTable;
use App\Models\LecturerEducation;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LecturerEducationResource extends Resource
{
    protected static ?string $model = LecturerEducation::class;
    protected static ?string $modelLabel = 'Riwayat Pendidikan Dosen';
    protected static ?string $pluralModelLabel = 'Riwayat Pendidikan Dosen';
    protected static ?string $navigationLabel = 'Pendidikan Dosen';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBookOpen;

    public static function form(Schema $schema): Schema
    {
        $schema = LecturerEducationForm::configure($schema);
        $components = array_merge($schema->getComponents() ?? [], \App\Helpers\DynamicFieldsHelper::getFormComponents(self::$model));
        return $schema->components($components);
    }

    public static function table(Table $table): Table
    {
        $table = LecturerEducationTable::configure($table);
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
            'index' => ListLecturerEducation::route('/'),
            'create' => CreateLecturerEducation::route('/create'),
            'edit' => EditLecturerEducation::route('/{record}/edit'),
        ];
    }
}
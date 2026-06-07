<?php

namespace App\Filament\Resources\Lecturers;

use App\Filament\Resources\Lecturers\Pages\CreateLecturer;
use App\Filament\Resources\Lecturers\Pages\EditLecturer;
use App\Filament\Resources\Lecturers\Pages\ListLecturers;
use App\Filament\Resources\Lecturers\Pages\ViewLecturer;
use App\Filament\Resources\Lecturers\Schemas\LecturerForm;
use App\Filament\Resources\Lecturers\Schemas\LecturerInfolist;
use App\Filament\Resources\Lecturers\Tables\LecturersTable;
use App\Models\Lecturer;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LecturerResource extends Resource
{
    protected static ?string $model = Lecturer::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationLabel = 'Dosen';
    protected static ?string $pluralModelLabel = 'Dosen';
    protected static ?string $modelLabel = 'Dosen';

    public static function form(Schema $schema): Schema
    {
        $schema = LecturerForm::configure($schema);
        $components = array_merge($schema->getComponents() ?? [], \App\Helpers\DynamicFieldsHelper::getFormComponents(self::$model));
        return $schema->components($components);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LecturerInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        $table = LecturersTable::configure($table);
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
            'index' => ListLecturers::route('/'),
            'create' => CreateLecturer::route('/create'),
            'view' => ViewLecturer::route('/{record}'),
            'edit' => EditLecturer::route('/{record}/edit'),
        ];
    }
}

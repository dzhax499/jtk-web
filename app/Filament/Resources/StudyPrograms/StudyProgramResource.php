<?php

namespace App\Filament\Resources\StudyPrograms;

use App\Filament\Resources\StudyPrograms\Pages\CreateStudyProgram;
use App\Filament\Resources\StudyPrograms\Pages\EditStudyProgram;
use App\Filament\Resources\StudyPrograms\Pages\ListStudyPrograms;
use App\Filament\Resources\StudyPrograms\Schemas\StudyProgramForm;
use App\Filament\Resources\StudyPrograms\Tables\StudyProgramsTable;
use App\Models\StudyProgram;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class StudyProgramResource extends Resource
{
    protected static ?string $model = StudyProgram::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        $schema = StudyProgramForm::configure($schema);
        $components = array_merge($schema->getComponents() ?? [], \App\Helpers\DynamicFieldsHelper::getFormComponents(self::$model));
        return $schema->components($components);
    }

    public static function table(Table $table): Table
    {
        $table = StudyProgramsTable::configure($table);
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
            'index' => ListStudyPrograms::route('/'),
            'create' => CreateStudyProgram::route('/create'),
            'edit' => EditStudyProgram::route('/{record}/edit'),
        ];
    }
}

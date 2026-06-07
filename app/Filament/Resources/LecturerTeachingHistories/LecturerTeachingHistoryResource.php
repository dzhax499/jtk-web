<?php

namespace App\Filament\Resources\LecturerTeachingHistories;

use App\Filament\Resources\LecturerTeachingHistories\Pages\CreateLecturerTeachingHistory;
use App\Filament\Resources\LecturerTeachingHistories\Pages\EditLecturerTeachingHistory;
use App\Filament\Resources\LecturerTeachingHistories\Pages\ListLecturerTeachingHistories;
use App\Filament\Resources\LecturerTeachingHistories\Pages\ViewLecturerTeachingHistory;
use App\Filament\Resources\LecturerTeachingHistories\Schemas\LecturerTeachingHistoryForm;
use App\Filament\Resources\LecturerTeachingHistories\Schemas\LecturerTeachingHistoryInfolist;
use App\Filament\Resources\LecturerTeachingHistories\Tables\LecturerTeachingHistoriesTable;
use App\Models\LecturerTeachingHistory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LecturerTeachingHistoryResource extends Resource
{
    protected static ?string $model = LecturerTeachingHistory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'course_name';

    public static function form(Schema $schema): Schema
    {
        $schema = LecturerTeachingHistoryForm::configure($schema);
        $components = array_merge($schema->getComponents() ?? [], \App\Helpers\DynamicFieldsHelper::getFormComponents(self::$model));
        return $schema->components($components);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LecturerTeachingHistoryInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        $table = LecturerTeachingHistoriesTable::configure($table);
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
            'index' => ListLecturerTeachingHistories::route('/'),
            'create' => CreateLecturerTeachingHistory::route('/create'),
            'view' => ViewLecturerTeachingHistory::route('/{record}'),
            'edit' => EditLecturerTeachingHistory::route('/{record}/edit'),
        ];
    }
}

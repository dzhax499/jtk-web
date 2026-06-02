<?php

namespace App\Filament\Resources\ExpertiseAreas;

use App\Filament\Resources\ExpertiseAreas\Pages\CreateExpertiseArea;
use App\Filament\Resources\ExpertiseAreas\Pages\EditExpertiseArea;
use App\Filament\Resources\ExpertiseAreas\Pages\ListExpertiseAreas;
use App\Filament\Resources\ExpertiseAreas\Pages\ViewExpertiseArea;
use App\Filament\Resources\ExpertiseAreas\Schemas\ExpertiseAreaForm;
use App\Filament\Resources\ExpertiseAreas\Schemas\ExpertiseAreaInfolist;
use App\Filament\Resources\ExpertiseAreas\Tables\ExpertiseAreasTable;
use App\Models\ExpertiseArea;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ExpertiseAreaResource extends Resource
{
    protected static ?string $model = ExpertiseArea::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAcademicCap;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return ExpertiseAreaForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ExpertiseAreaInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ExpertiseAreasTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListExpertiseAreas::route('/'),
            'create' => CreateExpertiseArea::route('/create'),
            'view' => ViewExpertiseArea::route('/{record}'),
            'edit' => EditExpertiseArea::route('/{record}/edit'),
        ];
    }
}

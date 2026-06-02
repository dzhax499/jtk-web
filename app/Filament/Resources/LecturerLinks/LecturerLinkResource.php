<?php

namespace App\Filament\Resources\LecturerLinks;

use App\Filament\Resources\LecturerLinks\Pages\CreateLecturerLink;
use App\Filament\Resources\LecturerLinks\Pages\EditLecturerLink;
use App\Filament\Resources\LecturerLinks\Pages\ListLecturerLinks;
use App\Filament\Resources\LecturerLinks\Pages\ViewLecturerLink;
use App\Filament\Resources\LecturerLinks\Schemas\LecturerLinkForm;
use App\Filament\Resources\LecturerLinks\Schemas\LecturerLinkInfolist;
use App\Filament\Resources\LecturerLinks\Tables\LecturerLinksTable;
use App\Models\LecturerLink;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LecturerLinkResource extends Resource
{
    protected static ?string $model = LecturerLink::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedLink;

    protected static ?string $recordTitleAttribute = 'platform';

    public static function form(Schema $schema): Schema
    {
        return LecturerLinkForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LecturerLinkInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LecturerLinksTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLecturerLinks::route('/'),
            'create' => CreateLecturerLink::route('/create'),
            'view' => ViewLecturerLink::route('/{record}'),
            'edit' => EditLecturerLink::route('/{record}/edit'),
        ];
    }
}

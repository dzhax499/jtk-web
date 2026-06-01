<?php

namespace App\Filament\Resources\LecturerLinks\Pages;

use App\Filament\Resources\LecturerLinks\LecturerLinkResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLecturerLinks extends ListRecords
{
    protected static string $resource = LecturerLinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

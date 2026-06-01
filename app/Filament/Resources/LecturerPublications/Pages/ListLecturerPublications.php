<?php

namespace App\Filament\Resources\LecturerPublications\Pages;

use App\Filament\Resources\LecturerPublications\LecturerPublicationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLecturerPublications extends ListRecords
{
    protected static string $resource = LecturerPublicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

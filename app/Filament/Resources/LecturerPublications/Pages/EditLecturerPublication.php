<?php

namespace App\Filament\Resources\LecturerPublications\Pages;

use App\Filament\Resources\LecturerPublications\LecturerPublicationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLecturerPublication extends EditRecord
{
    protected static string $resource = LecturerPublicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    public function getBreadcrumbs(): array
    {
        return [];
    }
}

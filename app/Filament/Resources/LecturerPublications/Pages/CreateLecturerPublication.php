<?php

namespace App\Filament\Resources\LecturerPublications\Pages;

use App\Filament\Resources\LecturerPublications\LecturerPublicationResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLecturerPublication extends CreateRecord
{
    protected static string $resource = LecturerPublicationResource::class;

    protected static ?string $title = 'Buat Publikasi Dosen';

    public function getBreadcrumbs(): array
    {
        return [];
    }
}

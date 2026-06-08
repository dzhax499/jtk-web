<?php

namespace App\Filament\Resources\LecturerPortfolioItems\Pages;

use App\Filament\Resources\LecturerPortfolioItems\LecturerPortfolioItemResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLecturerPortfolioItem extends CreateRecord
{
    protected static string $resource = LecturerPortfolioItemResource::class;
    protected static ?string $title = 'Buat Portofolio Dosen';

    public function getBreadcrumbs(): array
    {
        return [];
    }
}

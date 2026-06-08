<?php

namespace App\Filament\Resources\LecturerPortfolioItems\Pages;

use App\Filament\Resources\LecturerPortfolioItems\LecturerPortfolioItemResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewLecturerPortfolioItem extends ViewRecord
{
    protected static string $resource = LecturerPortfolioItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }

    public function getBreadcrumbs(): array
    {
        return [];
    }
}

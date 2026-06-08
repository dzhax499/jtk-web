<?php

namespace App\Filament\Resources\LecturerPortfolioItems\Pages;

use App\Filament\Resources\LecturerPortfolioItems\LecturerPortfolioItemResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditLecturerPortfolioItem extends EditRecord
{
    protected static string $resource = LecturerPortfolioItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    public function getBreadcrumbs(): array
    {
        return [];
    }
}

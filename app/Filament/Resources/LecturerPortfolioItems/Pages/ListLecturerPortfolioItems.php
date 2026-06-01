<?php

namespace App\Filament\Resources\LecturerPortfolioItems\Pages;

use App\Filament\Resources\LecturerPortfolioItems\LecturerPortfolioItemResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLecturerPortfolioItems extends ListRecords
{
    protected static string $resource = LecturerPortfolioItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

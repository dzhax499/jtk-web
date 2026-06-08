<?php

namespace App\Filament\Resources\LecturerPortfolioItems\Pages;

use App\Filament\Resources\LecturerPortfolioItems\LecturerPortfolioItemResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\HtmlString; 
use Illuminate\Contracts\Support\Htmlable;

class ListLecturerPortfolioItems extends ListRecords
{
    protected static string $resource = LecturerPortfolioItemResource::class;

    public function getHeading(): string | Htmlable
    {
        return new HtmlString('<span style="color: #00008B; font-size: 2.25rem;" class="font-extrabold tracking-tight">Daftar Portfolio Dosen</span>');
    }

    public function getBreadcrumbs(): array
    {
        return [];
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Buat Portofolio Dosen'),
        ];
    }
}

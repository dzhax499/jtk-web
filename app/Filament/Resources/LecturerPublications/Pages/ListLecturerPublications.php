<?php

namespace App\Filament\Resources\LecturerPublications\Pages;

use App\Filament\Resources\LecturerPublications\LecturerPublicationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\HtmlString; 
use Illuminate\Contracts\Support\Htmlable;

class ListLecturerPublications extends ListRecords
{
    protected static string $resource = LecturerPublicationResource::class;

    public function getHeading(): string | Htmlable
    {
        return new HtmlString('<span style="color: #00008B; font-size: 2.25rem;" class="font-extrabold tracking-tight">Publikasi Dosen</span>');
    }

    public function getBreadcrumbs(): array
    {
        return [];
    }
    
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Buat Publikasi Dosen'),
        ];
    }
}

<?php

namespace App\Filament\Resources\ExpertiseAreas\Pages;

use App\Filament\Resources\ExpertiseAreas\ExpertiseAreaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;

class ListExpertiseAreas extends ListRecords
{
    protected static string $resource = ExpertiseAreaResource::class;

    public function getTitle(): string | Htmlable
    {
        return new HtmlString('<span style="color: #00008B;">Daftar Bidang Keahlian</span>');
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Bidang Keahlian'),
        ];
    }
}
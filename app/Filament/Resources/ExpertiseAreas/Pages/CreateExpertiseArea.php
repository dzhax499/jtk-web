<?php

namespace App\Filament\Resources\ExpertiseAreas\Pages;

use App\Filament\Resources\ExpertiseAreas\ExpertiseAreaResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;

class CreateExpertiseArea extends CreateRecord
{
    protected static string $resource = ExpertiseAreaResource::class;

    public function getTitle(): string | Htmlable
    {
        return new HtmlString('<span style="color: #00008B;">Tambah Bidang Keahlian</span>');
    }
}
<?php

namespace App\Filament\Resources\ExpertiseAreas\Pages;

use App\Filament\Resources\ExpertiseAreas\ExpertiseAreaResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;

class ViewExpertiseArea extends ViewRecord
{
    protected static string $resource = ExpertiseAreaResource::class;

    public function getTitle(): string | Htmlable
    {
        return new HtmlString('<span style="color: #00008B;">Detail Bidang Keahlian</span>');
    }

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()->label('Ubah'),
        ];
    }
}
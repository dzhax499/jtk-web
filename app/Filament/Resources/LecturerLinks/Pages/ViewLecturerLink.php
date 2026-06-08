<?php

namespace App\Filament\Resources\LecturerLinks\Pages;

use App\Filament\Resources\LecturerLinks\LecturerLinkResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;

class ViewLecturerLink extends ViewRecord
{
    protected static string $resource = LecturerLinkResource::class;

    public function getTitle(): string | Htmlable
    {
        return new HtmlString('<span style="color: #00008B;">Detail Tautan Dosen</span>');
    }

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()->label('Ubah'),
        ];
    }
}
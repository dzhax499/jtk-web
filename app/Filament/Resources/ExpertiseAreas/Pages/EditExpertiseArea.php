<?php

namespace App\Filament\Resources\ExpertiseAreas\Pages;

use App\Filament\Resources\ExpertiseAreas\ExpertiseAreaResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;

class EditExpertiseArea extends EditRecord
{
    protected static string $resource = ExpertiseAreaResource::class;

    public function getTitle(): string | Htmlable
    {
        return new HtmlString('<span style="color: #00008B;">Ubah Bidang Keahlian</span>');
    }

    protected function getHeaderActions(): array
    {
        return [
            // Mengubah label tombol
            ViewAction::make()->label('Lihat'),
            DeleteAction::make()->label('Hapus'),
        ];
    }
}
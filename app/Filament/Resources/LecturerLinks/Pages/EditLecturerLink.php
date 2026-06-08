<?php

namespace App\Filament\Resources\LecturerLinks\Pages;

use App\Filament\Resources\LecturerLinks\LecturerLinkResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;

class EditLecturerLink extends EditRecord
{
    protected static string $resource = LecturerLinkResource::class;

    public function getTitle(): string | Htmlable
    {
        return new HtmlString('<span style="color: #00008B;">Ubah Tautan Dosen</span>');
    }

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make()->label('Lihat'),
            DeleteAction::make()->label('Hapus'),
        ];
    }
}
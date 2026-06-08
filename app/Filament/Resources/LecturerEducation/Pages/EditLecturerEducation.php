<?php

namespace App\Filament\Resources\LecturerEducation\Pages;

use App\Filament\Resources\LecturerEducation\LecturerEducationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;

class EditLecturerEducation extends EditRecord
{
    protected static string $resource = LecturerEducationResource::class;

    public function getTitle(): string | Htmlable
    {
        return new HtmlString('<span style="color: #00008B;">Ubah Riwayat Pendidikan</span>');
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->label('Hapus'),
        ];
    }
}
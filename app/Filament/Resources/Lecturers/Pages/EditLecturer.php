<?php

namespace App\Filament\Resources\Lecturers\Pages;

use App\Filament\Resources\Lecturers\LecturerResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;
use Filament\Actions\Action;

class EditLecturer extends EditRecord
{
    protected static string $resource = LecturerResource::class;

    public function getHeading(): string | Htmlable
    {
        return new HtmlString('<span style="color: #00008B; font-size: 2.25rem;" class="font-extrabold tracking-tight">Ubah Dosen</span>');
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->label('Hapus'),
        ];
    }

    protected function getSaveFormAction(): Action
    {
        return parent::getSaveFormAction()
            ->label('Simpan Perubahan');
    }

    protected function getCancelFormAction(): Action
    {
        return parent::getCancelFormAction()
            ->label('Batal');
    }
}

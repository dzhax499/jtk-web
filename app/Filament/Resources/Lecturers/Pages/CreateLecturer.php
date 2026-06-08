<?php

namespace App\Filament\Resources\Lecturers\Pages;

use App\Filament\Resources\Lecturers\LecturerResource;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateLecturer extends CreateRecord
{
    protected static string $resource = LecturerResource::class;

    public function getHeading(): string | Htmlable
    {
        return new HtmlString('<span style="color: #00008B; font-size: 2.25rem;" class="font-extrabold tracking-tight">Tambah Dosen</span>');
    }

    protected function getCreateFormAction(): Action
    {
        return parent::getCreateFormAction()
            ->label('Simpan');
    }

    protected function getCreateAnotherFormAction(): Action
    {
        return parent::getCreateAnotherFormAction()
            ->label('Simpan & Buat Baru');
    }

    protected function getCancelFormAction(): Action
    {
        return parent::getCancelFormAction()
            ->label('Kembali');
    }
}

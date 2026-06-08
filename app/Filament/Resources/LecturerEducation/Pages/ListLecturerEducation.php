<?php

namespace App\Filament\Resources\LecturerEducation\Pages;

use App\Filament\Resources\LecturerEducation\LecturerEducationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;

class ListLecturerEducation extends ListRecords
{
    protected static string $resource = LecturerEducationResource::class;

    public function getTitle(): string | Htmlable
    {
        return new HtmlString('<span style="color: #00008B;">Daftar Pendidikan Dosen</span>');
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Pendidikan'),
        ];
    }
}
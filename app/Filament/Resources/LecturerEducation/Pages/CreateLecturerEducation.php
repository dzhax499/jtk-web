<?php

namespace App\Filament\Resources\LecturerEducation\Pages;

use App\Filament\Resources\LecturerEducation\LecturerEducationResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;

class CreateLecturerEducation extends CreateRecord
{
    protected static string $resource = LecturerEducationResource::class;

    public function getTitle(): string | Htmlable
    {
        return new HtmlString('<span style="color: #00008B;">Tambah Riwayat Pendidikan</span>');
    }
}
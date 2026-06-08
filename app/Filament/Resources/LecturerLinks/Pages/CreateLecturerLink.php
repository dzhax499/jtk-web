<?php

namespace App\Filament\Resources\LecturerLinks\Pages;

use App\Filament\Resources\LecturerLinks\LecturerLinkResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;

class CreateLecturerLink extends CreateRecord
{
    protected static string $resource = LecturerLinkResource::class;

    public function getTitle(): string | Htmlable
    {
        return new HtmlString('<span style="color: #00008B;">Tambah Tautan Dosen</span>');
    }
}
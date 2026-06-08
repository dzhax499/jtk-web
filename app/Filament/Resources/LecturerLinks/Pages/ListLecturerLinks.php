<?php

namespace App\Filament\Resources\LecturerLinks\Pages;

use App\Filament\Resources\LecturerLinks\LecturerLinkResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;

class ListLecturerLinks extends ListRecords
{
    protected static string $resource = LecturerLinkResource::class;

    public function getTitle(): string | Htmlable
    {
        return new HtmlString('<span style="color: #00008B;">Daftar Tautan Dosen</span>');
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Tautan'),
        ];
    }
}
<?php

namespace App\Filament\Resources\Lecturers\Pages;

use App\Filament\Resources\Lecturers\LecturerResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;

class ListLecturers extends ListRecords
{
    protected static string $resource = LecturerResource::class;

    public function getHeading(): string | Htmlable
    {
        return new HtmlString('<span style="color: #00008B; font-size: 2.25rem;" class="font-extrabold tracking-tight">Dosen</span>');
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Dosen')
                ->color('primary'),
        ];
    }
}

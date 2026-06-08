<?php

namespace App\Filament\Resources\LecturerTeachingHistories\Pages;

use App\Filament\Resources\LecturerTeachingHistories\LecturerTeachingHistoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\HtmlString; 
use Illuminate\Contracts\Support\Htmlable;

class ListLecturerTeachingHistories extends ListRecords
{
    protected static string $resource = LecturerTeachingHistoryResource::class;

    public function getHeading(): string | Htmlable
    {
        return new HtmlString('<span style="color: #00008B; font-size: 2.25rem;" class="font-extrabold tracking-tight">Publikasi Dosen</span>');
    }

    public function getBreadcrumbs(): array
    {
        return [];
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Buat Riwayat Mengajar Dosen'),
        ];
    }
}

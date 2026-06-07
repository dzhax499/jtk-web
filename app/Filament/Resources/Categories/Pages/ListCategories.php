<?php

namespace App\Filament\Resources\Categories\Pages;

use App\Filament\Resources\Categories\CategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;

    // 2. Mengubah Judul Halaman Menjadi Biru
    public function getHeading(): string | Htmlable
    {
        return new HtmlString('<span style="color: #00008B; font-size: 2.25rem;" class="font-extrabold tracking-tight">Kategori</span>');
    }

    // 3. Menghilangkan Breadcrumbs (tulisan Categories > List)
    public function getBreadcrumbs(): array
    {
        return [];
    }

    // 4. Mengubah Teks & Warna Tombol
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Kategori')
                ->color('primary'),
        ];
    }
}
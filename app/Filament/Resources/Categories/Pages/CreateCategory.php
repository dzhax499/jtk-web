<?php

namespace App\Filament\Resources\Categories\Pages;

use App\Filament\Resources\Categories\CategoryResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;
use Filament\Actions\Action;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;

    // 1. Mengubah Judul Menjadi "Tambah Kategori" dan Berwarna Biru
    public function getHeading(): string | Htmlable
    {
        return new HtmlString('<span style="color: #00008B; font-size: 2.25rem;" class="font-extrabold tracking-tight">Tambah Kategori</span>');
    }

    // 2. Menghapus Breadcrumbs (Kategori > Create)
    public function getBreadcrumbs(): array
    {
        return [];
    }

    // 3. Mengubah bahasa tombol "Create"
    protected function getCreateFormAction(): Action
    {
        return parent::getCreateFormAction()
            ->label('Simpan');
    }

    // 4. Mengubah bahasa tombol "Create & create another"
    protected function getCreateAnotherFormAction(): Action
    {
        return parent::getCreateAnotherFormAction()
            ->label('Simpan & Buat Baru');
    }

    // 5. Mengubah bahasa tombol "Cancel"
    protected function getCancelFormAction(): Action
    {
        return parent::getCancelFormAction()
            ->label('Batal');
    }
}
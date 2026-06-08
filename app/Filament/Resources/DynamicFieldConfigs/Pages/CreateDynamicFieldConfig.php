<?php

namespace App\Filament\Resources\DynamicFieldConfigs\Pages;

use App\Filament\Resources\DynamicFieldConfigs\DynamicFieldConfigResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;

class CreateDynamicFieldConfig extends CreateRecord
{
    protected static string $resource = DynamicFieldConfigResource::class;

    public function getHeading(): string | Htmlable
    {
        return new HtmlString('<span style="color: #00008B; font-size: 2.25rem;" class="font-extrabold tracking-tight">Tambah Kolom Dinamis</span>');
    }

    public function getBreadcrumbs(): array
    {
        return [];
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

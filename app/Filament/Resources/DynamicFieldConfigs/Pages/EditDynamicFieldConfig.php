<?php

namespace App\Filament\Resources\DynamicFieldConfigs\Pages;

use App\Filament\Resources\DynamicFieldConfigs\DynamicFieldConfigResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;
use Filament\Actions\Action;

class EditDynamicFieldConfig extends EditRecord
{
    protected static string $resource = DynamicFieldConfigResource::class;

    public function getHeading(): string | Htmlable
    {
        return new HtmlString('<span style="color: #00008B; font-size: 2.25rem;" class="font-extrabold tracking-tight">Edit Kolom Dinamis</span>');
    }

    public function getBreadcrumbs(): array
    {
        return [];
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->label('Hapus Field'),
        ];
    }

    protected function getSaveFormAction(): Action
    {
        return parent::getSaveFormAction()
            ->label('Simpan Perubahan');
    }

    protected function getCancelFormAction(): Action
    {
        return parent::getCancelFormAction()
            ->label('Batal');
    }
}

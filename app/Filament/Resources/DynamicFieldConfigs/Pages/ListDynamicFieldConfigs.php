<?php

namespace App\Filament\Resources\DynamicFieldConfigs\Pages;

use App\Filament\Resources\DynamicFieldConfigs\DynamicFieldConfigResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;

class ListDynamicFieldConfigs extends ListRecords
{
    protected static string $resource = DynamicFieldConfigResource::class;

    public function getHeading(): string | Htmlable
    {
        return new HtmlString('<span style="color: #00008B; font-size: 2.25rem;" class="font-extrabold tracking-tight">Dynamic Fields</span>');
    }

    public function getBreadcrumbs(): array
    {
        return [];
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Field Baru')
                ->color('primary'),
        ];
    }
}

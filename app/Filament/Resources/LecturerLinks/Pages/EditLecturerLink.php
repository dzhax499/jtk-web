<?php

namespace App\Filament\Resources\LecturerLinks\Pages;

use App\Filament\Resources\LecturerLinks\LecturerLinkResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditLecturerLink extends EditRecord
{
    protected static string $resource = LecturerLinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}

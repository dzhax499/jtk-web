<?php

namespace App\Filament\Resources\ExpertiseAreas\Pages;

use App\Filament\Resources\ExpertiseAreas\ExpertiseAreaResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditExpertiseArea extends EditRecord
{
    protected static string $resource = ExpertiseAreaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}

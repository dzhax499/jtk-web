<?php

namespace App\Filament\Resources\LecturerEducation\Pages;

use App\Filament\Resources\LecturerEducation\LecturerEducationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLecturerEducation extends EditRecord
{
    protected static string $resource = LecturerEducationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

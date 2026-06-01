<?php

namespace App\Filament\Resources\LecturerEducation\Pages;

use App\Filament\Resources\LecturerEducation\LecturerEducationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLecturerEducation extends ListRecords
{
    protected static string $resource = LecturerEducationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

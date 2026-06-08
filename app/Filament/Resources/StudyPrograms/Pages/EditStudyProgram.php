<?php

namespace App\Filament\Resources\StudyPrograms\Pages;

use App\Filament\Resources\StudyPrograms\StudyProgramResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditStudyProgram extends EditRecord
{
    protected static string $resource = StudyProgramResource::class;

    public function getBreadcrumbs(): array
    {
        return [];
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

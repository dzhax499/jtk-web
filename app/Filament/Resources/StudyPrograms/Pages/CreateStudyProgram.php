<?php

namespace App\Filament\Resources\StudyPrograms\Pages;

use App\Filament\Resources\StudyPrograms\StudyProgramResource;
use Filament\Resources\Pages\CreateRecord;

class CreateStudyProgram extends CreateRecord
{
    protected static string $resource = StudyProgramResource::class;

    protected static ?string $title = 'Buat Program Studi';

    public function getBreadcrumbs(): array
    {
        return [];
    }
}

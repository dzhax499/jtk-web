<?php

namespace App\Filament\Resources\StudyPrograms\Pages;

use App\Filament\Resources\StudyPrograms\StudyProgramResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\HtmlString; 
use Illuminate\Contracts\Support\Htmlable;

class ListStudyPrograms extends ListRecords
{
    protected static string $resource = StudyProgramResource::class;

    public function getHeading(): string | Htmlable
    {
        return new HtmlString('<span style="color: #00008B; font-size: 2.25rem;" class="font-extrabold tracking-tight">Program Studi</span>');
    }

    public function getBreadcrumbs(): array
    {
        return [];
    }
    
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Program Studi'),
        ];
    }
}

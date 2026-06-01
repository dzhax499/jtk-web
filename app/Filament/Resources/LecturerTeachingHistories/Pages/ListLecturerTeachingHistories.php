<?php

namespace App\Filament\Resources\LecturerTeachingHistories\Pages;

use App\Filament\Resources\LecturerTeachingHistories\LecturerTeachingHistoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLecturerTeachingHistories extends ListRecords
{
    protected static string $resource = LecturerTeachingHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

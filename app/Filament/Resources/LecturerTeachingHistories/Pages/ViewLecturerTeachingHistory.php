<?php

namespace App\Filament\Resources\LecturerTeachingHistories\Pages;

use App\Filament\Resources\LecturerTeachingHistories\LecturerTeachingHistoryResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewLecturerTeachingHistory extends ViewRecord
{
    protected static string $resource = LecturerTeachingHistoryResource::class;

    public function getBreadcrumbs(): array
    {
        return [];
    }

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

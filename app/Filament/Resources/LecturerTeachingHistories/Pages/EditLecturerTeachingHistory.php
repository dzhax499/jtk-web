<?php

namespace App\Filament\Resources\LecturerTeachingHistories\Pages;

use App\Filament\Resources\LecturerTeachingHistories\LecturerTeachingHistoryResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditLecturerTeachingHistory extends EditRecord
{
    protected static string $resource = LecturerTeachingHistoryResource::class;

    public function getBreadcrumbs(): array
    {
        return [];
    }

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}

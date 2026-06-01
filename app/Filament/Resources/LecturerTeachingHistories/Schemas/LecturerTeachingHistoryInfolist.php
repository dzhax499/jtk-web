<?php

namespace App\Filament\Resources\LecturerTeachingHistories\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class LecturerTeachingHistoryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('lecturer.name')
                    ->label('Lecturer'),
                TextEntry::make('studyProgram.name')
                    ->label('Study Program'),
                TextEntry::make('nidn')
                    ->placeholder('-'),
                TextEntry::make('semester_name')
                    ->placeholder('-'),
                TextEntry::make('course_code')
                    ->placeholder('-'),
                TextEntry::make('course_name'),
                TextEntry::make('class_name')
                    ->placeholder('-'),
                TextEntry::make('academic_year')
                    ->placeholder('-'),
                IconEntry::make('is_active')
                    ->boolean(),
                TextEntry::make('raw_data')
                    ->placeholder('-')
                    ->columnSpanFull(),
            ]);
    }
}

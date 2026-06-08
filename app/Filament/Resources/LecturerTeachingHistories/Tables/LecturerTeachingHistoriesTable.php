<?php

namespace App\Filament\Resources\LecturerTeachingHistories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LecturerTeachingHistoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('lecturer.name')
                    ->label('Dosen')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('studyProgram.name')
                    ->label('Program Studi')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('nidn')
                    ->label('NIDN')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('semester_name')
                    ->label('Semester')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('course_code')
                    ->label('Kode Mata Kuliah')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('course_name')
                    ->label('Nama Mata Kuliah')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('class_name')
                    ->label('Nama Kelas')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('academic_year')
                    ->label('Tahun Akademik')
                    ->sortable()
                    ->searchable(),
                IconColumn::make('is_active')
                    ->label('Status Aktif')
                    ->boolean()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

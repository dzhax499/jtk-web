<?php

namespace App\Filament\Resources\LecturerEducation\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LecturerEducationTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('lecturer.name')
                    ->label('Lecturer')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('nidn')
                    ->searchable(),
                TextColumn::make('degree_level')
                    ->searchable(),
                TextColumn::make('institution_name')
                    ->searchable(),
                TextColumn::make('study_program')
                    ->searchable(),
                TextColumn::make('start_year')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('graduation_year')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('academic_degree')
                    ->searchable(),
                TextColumn::make('degree_abbreviation')
                    ->searchable(),
                TextColumn::make('sort_order')
                    ->numeric()
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
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

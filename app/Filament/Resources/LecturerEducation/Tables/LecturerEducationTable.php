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
                    ->label('Dosen')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('nidn')
                    ->label('NIDN')
                    ->searchable(),
                TextColumn::make('degree_level')
                    ->label('Jenjang Pendidikan')
                    ->searchable(),
                TextColumn::make('institution_name')
                    ->label('Perguruan Tinggi')
                    ->searchable(),
                TextColumn::make('study_program')
                    ->label('Program Studi')
                    ->searchable(),
                TextColumn::make('start_year')
                    ->label('Tahun Mulai')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('graduation_year')
                    ->label('Tahun Lulus')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('academic_degree')
                    ->label('Gelar Akademik')
                    ->searchable(),
                TextColumn::make('degree_abbreviation')
                    ->label('Singkatan Gelar')
                    ->searchable(),
                TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Diperbarui Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->label('Ubah'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label('Hapus Terpilih'),
                ]),
            ]);
    }
}
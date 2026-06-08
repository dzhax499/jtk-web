<?php

namespace App\Filament\Resources\LecturerPortfolioItems\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LecturerPortfolioItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('lecturer.name')
                    ->label('Dosen')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('type')
                    ->label('Tipe')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('title')
                    ->label('Judul')
                    ->limit(50)
                    ->searchable(),
                TextColumn::make('year')
                    ->label('Tahun')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('category')
                    ->label('Kategori')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('source')
                    ->label('Sumber')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
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

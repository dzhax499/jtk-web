<?php

namespace App\Filament\Resources\LecturerPublications\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LecturerPublicationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('lecturer.name')
                    ->label('Dosen')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('source')
                    ->label('Sumber')
                    ->searchable(),
                TextColumn::make('category')
                    ->label('Kategori')
                    ->searchable(),
                TextColumn::make('year')
                    ->label('Tahun')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('citation_count')
                    ->label('Jumlah Sitasi')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('venue')
                    ->label('Tempat Publikasi')
                    ->searchable(),
                TextColumn::make('publisher')
                    ->label('Penerbit')
                    ->searchable(),
                TextColumn::make('doi')
                    ->label('DOI')
                    ->searchable(),
                TextColumn::make('eid')
                    ->label('EID')
                    ->searchable(),
                TextColumn::make('sinta_id')
                    ->label('SINTA ID')
                    ->searchable(),
                TextColumn::make('scopus_author_id')
                    ->label('Scopus Author ID')
                    ->searchable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->searchable(),
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

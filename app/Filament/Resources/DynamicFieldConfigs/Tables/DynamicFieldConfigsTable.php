<?php

namespace App\Filament\Resources\DynamicFieldConfigs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;

class DynamicFieldConfigsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('label')
                    ->label('Label Form')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('name')
                    ->label('Nama Kunci (JSON Key)')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('type')
                    ->label('Tipe Input')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'text' => 'gray',
                        'textarea' => 'warning',
                        'number' => 'info',
                        'select' => 'success',
                        'toggle' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('target_resource')
                    ->label('Resource Target')
                    ->formatStateUsing(function (string $state) {
                        $parts = explode('\\', $state);
                        return end($parts);
                    })
                    ->sortable(),

                IconColumn::make('is_required')
                    ->label('Wajib')
                    ->boolean()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
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

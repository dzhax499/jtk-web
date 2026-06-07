<?php

namespace App\Filament\Resources\Pages\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PagesTable
{
    private const DATETIME_FORMAT = 'd M Y, H:i';

    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('title')
                    ->label('Judul Halaman')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->limit(50)
                    ->tooltip(fn ($record) => $record->title),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'publish' => 'success',
                        'draft'   => 'warning',
                        default   => 'gray',
                    }),

                TextColumn::make('author.name')
                    ->label('Penulis')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('parent.title')
                    ->label('Halaman Induk')
                    ->placeholder('(Halaman Utama)')
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('published_at')
                    ->label('Tanggal Terbit')
                    ->dateTime(self::DATETIME_FORMAT)
                    ->sortable(),

                TextColumn::make('slug')
                    ->label('URL Slug')
                    ->searchable()
                    ->copyable()
                    ->tooltip('Klik untuk menyalin slug')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime(self::DATETIME_FORMAT)
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Terakhir Diubah')
                    ->dateTime(self::DATETIME_FORMAT)
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()->label('Ubah'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label('Hapus Terpilih'),
                ]),
            ])
            ->emptyStateHeading('Belum Ada Halaman')
            ->emptyStateDescription('Silakan tambah halaman baru melalui tombol di kanan atas.');
    }
}

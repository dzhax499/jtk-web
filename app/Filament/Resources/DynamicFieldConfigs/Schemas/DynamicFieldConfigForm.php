<?php

namespace App\Filament\Resources\DynamicFieldConfigs\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\KeyValue;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class DynamicFieldConfigForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Kunci (JSON Key)')
                    ->required()
                    ->regex('/^[a-z0-9_]+$/')
                    ->validationMessages([
                        'regex' => 'Nama Kunci hanya boleh mengandung huruf kecil, angka, dan underscore (cth: award_count).',
                    ])
                    ->helperText('Digunakan sebagai nama kolom/kunci di dalam database (contoh: sertifikat_pendidik).')
                    ->maxLength(100),

                TextInput::make('label')
                    ->label('Label Form')
                    ->required()
                    ->helperText('Label yang akan tampil di form input (contoh: Sertifikat Pendidik).')
                    ->maxLength(100),

                Select::make('type')
                    ->label('Tipe Input')
                    ->options([
                        'text' => 'Teks Biasa (Text)',
                        'textarea' => 'Teks Panjang (Textarea)',
                        'number' => 'Angka (Number)',
                        'select' => 'Pilihan (Select)',
                        'toggle' => 'Pilihan Ya/Tidak (Toggle)',
                    ])
                    ->required()
                    ->live()
                    ->native(false),

                Select::make('target_resource')
                    ->label('Resource Target')
                    ->options(self::getTargetResources())
                    ->required()
                    ->native(false),

                Toggle::make('is_required')
                    ->label('Wajib Diisi (Required)')
                    ->default(false),

                TextInput::make('placeholder')
                    ->label('Placeholder')
                    ->helperText('Petunjuk teks di dalam field saat kosong.')
                    ->maxLength(255),

                KeyValue::make('options')
                    ->label('Opsi Pilihan (Hanya untuk Tipe Select)')
                    ->keyLabel('Kunci (Key)')
                    ->valueLabel('Nilai Tampilan (Label)')
                    ->helperText('Tambahkan opsi untuk dropdown select (contoh: sertifikasi_a => Sertifikasi A).')
                    ->visible(fn (Get $get) => $get('type') === 'select')
                    ->columnSpanFull(),
            ]);
    }

    public static function getTargetResources(): array
    {
        $modelsPath = app_path('Models');
        $models = [];

        if (is_dir($modelsPath)) {
            $files = scandir($modelsPath);
            foreach ($files as $file) {
                if ($file === '.' || $file === '..') {
                    continue;
                }
                $pathinfo = pathinfo($file);
                if (($pathinfo['extension'] ?? '') === 'php') {
                    $modelClass = 'App\\Models\\' . $pathinfo['filename'];
                    if (class_exists($modelClass)) {
                        // Display name as readable (e.g. Lecturer)
                        $models[$modelClass] = $pathinfo['filename'];
                    }
                }
            }
        }

        return $models;
    }
}

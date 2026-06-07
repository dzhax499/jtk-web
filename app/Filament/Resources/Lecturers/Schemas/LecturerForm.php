<?php

namespace App\Filament\Resources\Lecturers\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class LecturerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                // --- Identitas Utama ---
                TextInput::make('name')
                    ->label('Nama Lengkap (beserta Gelar)')
                    ->required()
                    ->maxLength(255),

                TextInput::make('slug')
                    ->label('URL Slug')
                    ->required()
                    ->maxLength(255),

                Select::make('gender')
                    ->label('Jenis Kelamin')
                    ->options([
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    ])
                    ->native(false),

                TextInput::make('email')
                    ->label('Alamat Email')
                    ->email()
                    ->maxLength(255),

                TextInput::make('photo_url')
                    ->label('URL Foto Profil')
                    ->url()
                    ->maxLength(255),

                Textarea::make('bio')
                    ->label('Biografi Singkat')
                    ->rows(4)
                    ->columnSpanFull(),

                // --- Data Kepegawaian ---
                TextInput::make('nip')
                    ->label('NIP / NIP CPNS')
                    ->maxLength(50),

                TextInput::make('nidn')
                    ->label('NIDN')
                    ->maxLength(20),

                TextInput::make('employment_status')
                    ->label('Status Ikatan')
                    ->placeholder('cth: Dosen Tetap')
                    ->maxLength(100),

                TextInput::make('activity_status')
                    ->label('Status Kegiatan')
                    ->placeholder('cth: Aktif Mengajar')
                    ->maxLength(100),

                Toggle::make('is_active')
                    ->label('Dosen Aktif (Tampil di Publik)')
                    ->default(true)
                    ->required(),

                // --- Data Akademik ---
                Select::make('study_program_id')
                    ->relationship('studyProgram', 'name')
                    ->label('Program Studi')
                    ->searchable()
                    ->preload()
                    ->native(false),

                TextInput::make('academic_position')
                    ->label('Jabatan Fungsional')
                    ->placeholder('cth: Lektor')
                    ->maxLength(100),

                TextInput::make('highest_education')
                    ->label('Pendidikan Terakhir')
                    ->placeholder('cth: S3')
                    ->maxLength(10),

                Select::make('expertiseAreas')
                    ->relationship('expertiseAreas', 'name')
                    ->label('Bidang Keahlian')
                    ->multiple()
                    ->searchable()
                    ->preload()
                    ->native(false),

            ]);
    }
}

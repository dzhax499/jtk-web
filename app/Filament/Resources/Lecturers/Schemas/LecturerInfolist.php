<?php

namespace App\Filament\Resources\Lecturers\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class LecturerInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                // --- Identitas Utama ---
                TextEntry::make('name')
                    ->label('Nama Lengkap'),

                TextEntry::make('gender')
                    ->label('Jenis Kelamin')
                    ->placeholder('-'),

                TextEntry::make('email')
                    ->label('Alamat Email')
                    ->placeholder('-'),

                TextEntry::make('photo_url')
                    ->label('URL Foto Profil')
                    ->placeholder('-'),

                TextEntry::make('bio')
                    ->label('Biografi Singkat')
                    ->placeholder('-')
                    ->columnSpanFull(),

                // --- Data Kepegawaian ---
                TextEntry::make('nip')
                    ->label('NIP / NIP CPNS')
                    ->placeholder('-'),

                TextEntry::make('nidn')
                    ->label('NIDN')
                    ->placeholder('-'),

                TextEntry::make('employment_status')
                    ->label('Ikatan Kerja')
                    ->placeholder('-'),

                TextEntry::make('activity_status')
                    ->label('Status Kegiatan')
                    ->placeholder('-'),

                IconEntry::make('is_active')
                    ->label('Dosen Aktif (Tampil di Publik)')
                    ->boolean(),

                // --- Data Akademik ---
                TextEntry::make('studyProgram.name')
                    ->label('Program Studi')
                    ->placeholder('-'),

                TextEntry::make('academic_position')
                    ->label('Jabatan Fungsional')
                    ->placeholder('-'),

                TextEntry::make('highest_education')
                    ->label('Pendidikan Terakhir')
                    ->placeholder('-'),

                TextEntry::make('expertiseAreas.name')
                    ->label('Bidang Keahlian')
                    ->badge()
                    ->placeholder('-'),

                // --- Sistem ---
                TextEntry::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('d M Y, H:i'),

                TextEntry::make('updated_at')
                    ->label('Diperbarui Pada')
                    ->dateTime('d M Y, H:i'),

            ]);
    }
}

<?php

namespace App\Filament\Resources\StudyPrograms\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Schema;

class StudyProgramForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Program Studi')
                    ->required(),
                TextInput::make('slug')
                    ->label('Slug')
                    ->required(),
                TextInput::make('degree')
                    ->label('Tingkat Pendidikan')
                    ->required(),
                Toggle::make('is_active')
                    ->label('Status Aktif')
                    ->required(),
                Textarea::make('description')
                    ->label('Deskripsi')
                    ->columnSpanFull(),
                Textarea::make('vision')
                    ->label('Visi')
                    ->columnSpanFull(),
                Textarea::make('mission')
                    ->label('Misi')
                    ->placeholder("Satu misi per baris")
                    ->columnSpanFull(),
                
                Repeater::make('objectives')
                    ->simple(TextInput::make('objective')->required())
                    ->label('Tujuan Program Studi')
                    ->columnSpanFull(),

                Repeater::make('graduate_profiles')
                    ->simple(TextInput::make('profile')->required())
                    ->label('Profil Lulusan')
                    ->columnSpanFull(),

                Repeater::make('job_positions')
                    ->schema([
                        TextInput::make('category')
                            ->required()
                            ->label('Kategori (e.g. OPERATOR, PROGRAMMER)'),
                        Repeater::make('items')
                            ->simple(TextInput::make('item')->required())
                            ->label('Daftar Posisi Kerja')
                            ->default([])
                    ])
                    ->label('Posisi Pekerjaan Yang Tersedia')
                    ->columnSpanFull(),

                Textarea::make('about')
                    ->label('Tentang Program Studi (D4)')
                    ->columnSpanFull(),

                Textarea::make('lecturer_qualification')
                    ->label('Kualifikasi Dosen (D4)')
                    ->columnSpanFull(),

                Repeater::make('facilities')
                    ->simple(TextInput::make('facility')->required())
                    ->label('Fasilitas Penunjang (D4)')
                    ->columnSpanFull(),

                Textarea::make('career_prospects')
                    ->label('Prospek Lulusan - Deskripsi (D4)')
                    ->columnSpanFull(),

                Repeater::make('career_prospects_list')
                    ->simple(TextInput::make('career')->required())
                    ->label('Prospek Lulusan - Daftar Poin (D4)')
                    ->columnSpanFull(),

                Textarea::make('accreditation_text')
                    ->label('Teks Akreditasi')
                    ->columnSpanFull(),
                
                TextInput::make('accreditation_certificate_url')
                    ->label('URL Sertifikat Akreditasi')
                    ->url()
                    ->columnSpanFull(),
                
                TextInput::make('accreditation_website_url')
                    ->label('URL Website LAM INFOKOM')
                    ->url()
                    ->columnSpanFull(),
            ]);
    }
}

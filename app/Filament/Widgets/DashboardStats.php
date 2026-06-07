<?php

namespace App\Filament\Widgets;

use App\Models\Lecturer;
use App\Models\Post;
use App\Models\StudyProgram;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStats extends BaseWidget
{
    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Dosen', Lecturer::count())
                ->description('Jumlah dosen terdaftar')
                ->descriptionIcon('heroicon-m-users')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('primary'),

            // Warnanya diubah jadi 'warning' (kuning/amber)
            Stat::make('Total Berita & Artikel', Post::count())
                ->description('Postingan aktif di web')
                ->descriptionIcon('heroicon-m-document-text')
                ->chart([3, 12, 4, 10, 15, 8, 20])
                ->color('warning'), 

            // Ditambahkan chart array agar muncul gelombang
            Stat::make('Program Studi', StudyProgram::count())
                ->description('Program Studi JTK POLBAN')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->chart([2, 5, 3, 7, 4, 6, 8]) 
                ->color('info'),
        ];
    }
}
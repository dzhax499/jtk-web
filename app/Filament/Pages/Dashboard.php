<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;

class Dashboard extends BaseDashboard
{
    // 1. Mengubah teks di tab browser dan sidebar
    protected static ?string $title = 'Beranda';
    protected static ?string $navigationLabel = 'Beranda';

    // 2. Mengubah teks judul H1 di dalam halamannya menjadi HTML Biru
    public function getHeading(): string | Htmlable
    {
        return new HtmlString('<span style="color: #00008B; font-size: 2.25rem;" class="font-extrabold tracking-tight">Beranda</span>');
    }
}
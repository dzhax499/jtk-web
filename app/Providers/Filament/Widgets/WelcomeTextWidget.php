<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class WelcomeTextWidget extends Widget
{
    protected static string $view = 'filament.widgets.welcome-text-widget';
    protected int | string | array $columnSpan = 'full'; // Agar teks membentang penuh
}
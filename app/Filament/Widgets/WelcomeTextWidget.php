<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class WelcomeTextWidget extends Widget
{
    protected string $view = 'filament.widgets.welcome-text-widget';
    
    protected int | string | array $columnSpan = 'full';
    
    // Angka minus memaksa widget ini selalu antre di nomor 1 paling atas
    protected static ?int $sort = -2; 
}
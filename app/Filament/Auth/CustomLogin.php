<?php

namespace App\Filament\Auth;

// 1. Menggunakan alamat yang terbukti BENAR di sistem kamu
use Filament\Auth\Pages\Login as BaseLogin;

class CustomLogin extends BaseLogin
{
    // 2. Tanpa kata "static", sesuai dengan aturan bawaan Filament
    protected string $view = 'filament.pages.auth.custom-login';
}
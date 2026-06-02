<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('sync:lecturer-data')
    ->cron('0 0 1 2,8 *')
    ->withoutOverlapping()
    ->appendOutputTo(storage_path('logs/sync-lecturer.log'))
    ->emailOutputOnFailure(env('ADMIN_EMAIL'));

Schedule::command('sync:lecturer-data --dry-run')
    ->monthlyOn(15)
    ->withoutOverlapping();

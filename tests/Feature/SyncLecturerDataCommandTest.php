<?php

namespace Tests\Feature;

use Tests\TestCase;

class SyncLecturerDataCommandTest extends TestCase
{
    public function test_command_registered(): void
    {
        $this->artisan('list')
            ->expectsOutputToContain('sync:lecturer-data');
    }

    public function test_dry_run_option_accepted(): void
    {
        $this->artisan('sync:lecturer-data --dry-run --only=biodata')
            ->assertFailed();
    }

    public function test_invalid_seeder_rejected(): void
    {
        $this->artisan('sync:lecturer-data --only=invalid')
            ->assertFailed()
            ->expectsOutputToContain('tidak dikenal');
    }

    public function test_schedule_registered(): void
    {
        $this->artisan('schedule:list')
            ->expectsOutputToContain('sync:lecturer-data');
    }
}

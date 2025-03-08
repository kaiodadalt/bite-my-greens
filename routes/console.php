<?php

declare(strict_types=1);

use App\Infrastructure\Jobs\AnnounceChallengeGroupWinner;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::job(new AnnounceChallengeGroupWinner)->daily();

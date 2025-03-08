<?php

declare(strict_types=1);

namespace App\Infrastructure\Listeners;

use App\Infrastructure\Events\ChallengeGroupPostCreated;

final class ProcessPost
{
    public function handle(): void
    {
        // TODO: receive ChallengeGroupPostCreated $event as parameter
        // TODO: 1. call the service to detects healthy ingredients
        // TODO: 2. based on the ingredients detected, set the post score and update the user ranking
    }
}

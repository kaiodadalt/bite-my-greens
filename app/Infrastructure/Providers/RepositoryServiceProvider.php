<?php

declare(strict_types=1);

namespace App\Infrastructure\Providers;

use App\Domain\ChallengeGroup\Contracts\ChallengeGroupRepository;
use App\Infrastructure\Persistence\Repositories\ChallengeGroup\ChallengeGroupEloquentRepository;
use Illuminate\Support\ServiceProvider;

final class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ChallengeGroupRepository::class, ChallengeGroupEloquentRepository::class);
    }
}

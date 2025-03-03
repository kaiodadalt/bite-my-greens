<?php

declare(strict_types=1);

namespace App\Infrastructure\Providers;

use App\Domain\ChallengeGroup\Contracts\ChallengeGroupPostRepository;
use App\Domain\ChallengeGroup\Contracts\ChallengeGroupRepository;
use App\Domain\ChallengeGroup\Contracts\ChallengeGroupUserRepository;
use App\Infrastructure\Persistence\Repositories\ChallengeGroup\ChallengeGroupEloquentRepository;
use App\Infrastructure\Persistence\Repositories\ChallengeGroup\ChallengeGroupPostEloquentRepository;
use App\Infrastructure\Persistence\Repositories\ChallengeGroup\ChallengeGroupUserEloquentRepository;
use Illuminate\Support\ServiceProvider;

final class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ChallengeGroupRepository::class, ChallengeGroupEloquentRepository::class);
        $this->app->bind(ChallengeGroupUserRepository::class, ChallengeGroupUserEloquentRepository::class);
        $this->app->bind(ChallengeGroupPostRepository::class, ChallengeGroupPostEloquentRepository::class);
    }
}

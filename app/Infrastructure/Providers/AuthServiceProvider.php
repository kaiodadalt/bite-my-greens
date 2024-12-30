<?php

namespace App\Infrastructure\Providers;

use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;
use App\Infrastructure\Persistence\Models\Auth\SanctumCache\PersonalAccessTokenWithCache;
use App\Infrastructure\Persistence\Repositories\PassportCache\ClientRepositoryWithCache;
use App\Infrastructure\Persistence\Repositories\PassportCache\RefreshTokenRepositoryWithCache;
use App\Infrastructure\Persistence\Repositories\PassportCache\TokenRepositoryWithCache;
use App\Infrastructure\Policies\ChallengeGroup\ChallengeGroupPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\ClientRepository;
use Laravel\Passport\Passport;
use Laravel\Passport\RefreshTokenRepository;
use Laravel\Passport\TokenRepository;
use Laravel\Sanctum\Sanctum;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        ChallengeGroupEntity::class => ChallengeGroupPolicy::class,
    ];

    public function register(): void
    {
        $this->registerPassportSingletons();
        parent::register();
    }


    public function boot(): void
    {
        $this->registerPolicies();
        $this->configurePassport();
        $this->configureSanctum();
    }

    private function configurePassport(): void {
        Passport::ignoreRoutes();
        Passport::hashClientSecrets();
        Passport::withCookieEncryption();
        Passport::withCookieSerialization();
        Passport::tokensExpireIn(now()->addDays(15));
        Passport::refreshTokensExpireIn(now()->addDays(30));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));
        Passport::cookie(env('PASSPORT_COOKIE_NAME', 'auth_cookie'));
    }

    private function configureSanctum(): void {
        Sanctum::usePersonalAccessTokenModel(PersonalAccessTokenWithCache::class);
    }

    private function registerPassportSingletons(): void {
        $this->app->singleton(TokenRepository::class, function () {
            return new TokenRepositoryWithCache();
        });

        $this->app->singleton(RefreshTokenRepository::class, function () {
            return new RefreshTokenRepositoryWithCache();
        });

        $this->app->singleton(ClientRepository::class, function () {
            return new ClientRepositoryWithCache();
        });
    }
}

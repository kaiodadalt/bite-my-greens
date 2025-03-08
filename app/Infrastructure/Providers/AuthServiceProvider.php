<?php

declare(strict_types=1);

namespace App\Infrastructure\Providers;

use App\Infrastructure\Persistence\Models\Auth\SanctumCache\PersonalAccessTokenWithCache;
use App\Infrastructure\Persistence\Repositories\PassportCache\ClientRepositoryWithCache;
use App\Infrastructure\Persistence\Repositories\PassportCache\RefreshTokenRepositoryWithCache;
use App\Infrastructure\Persistence\Repositories\PassportCache\TokenRepositoryWithCache;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Config;
use Laravel\Passport\ClientRepository;
use Laravel\Passport\Passport;
use Laravel\Passport\RefreshTokenRepository;
use Laravel\Passport\TokenRepository;
use Laravel\Sanctum\Sanctum;

final class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
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

    private function configurePassport(): void
    {
        Passport::ignoreRoutes();
        Passport::hashClientSecrets();
        Passport::withCookieEncryption();
        Passport::withCookieSerialization();
        Passport::tokensExpireIn(now()->addDays(15));
        Passport::refreshTokensExpireIn(now()->addDays(30));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));
        Passport::cookie(Config::string('passport.cookie_name'));
    }

    private function configureSanctum(): void
    {
        Sanctum::usePersonalAccessTokenModel(PersonalAccessTokenWithCache::class);
    }

    private function registerPassportSingletons(): void
    {
        $this->app->singleton(TokenRepository::class, fn (): TokenRepositoryWithCache => new TokenRepositoryWithCache);
        $this->app->singleton(RefreshTokenRepository::class, fn (): RefreshTokenRepositoryWithCache => new RefreshTokenRepositoryWithCache);
        $this->app->singleton(ClientRepository::class, fn (): ClientRepositoryWithCache => new ClientRepositoryWithCache);
    }
}

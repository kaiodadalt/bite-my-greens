<?php

namespace App\Providers;

use App\Models\Auth\SanctumCache\PersonalAccessTokenWithCache;
use App\Models\ChallengeGroups\ChallengeGroup;
use App\Policies\ChallengeGroup\ChallengeGroupPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
use Laravel\Sanctum\Sanctum;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        ChallengeGroup::class => ChallengeGroupPolicy::class,
    ];


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
}

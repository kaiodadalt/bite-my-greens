<?php

namespace App\Providers;

use App\Models\CachedAuth\CachedPersonalAccessToken;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url')."/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });

        $this->configureCommands();
        $this->configureModels();
        $this->configureUrl();

        Sanctum::usePersonalAccessTokenModel(CachedPersonalAccessToken::class);


//        Passport::withCookieEncryption();
//        Passport::withCookieSerialization();
//
//        Passport::hashClientSecrets();
//        Passport::tokensExpireIn(now()->addDays(15));
//        Passport::refreshTokensExpireIn(now()->addDays(30));
//        Passport::personalAccessTokensExpireIn(now()->addMonths(6));
    }

    private function configureCommands(): void {
        DB::prohibitDestructiveCommands($this->app->isProduction());
    }

    private function configureModels(): void {
        Model::shouldBeStrict();
        Model::unguard();
    }

    private function configureUrl(): void {
        if ($this->app->isProduction()) {
            URL::forceScheme('https');
        }
    }
}

<?php

namespace App\Providers;

use App\Repositories\PassportCache\ClientRepositoryWithCache;
use App\Repositories\PassportCache\RefreshTokenRepositoryWithCache;
use App\Repositories\PassportCache\TokenRepositoryWithCache;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\ClientRepository;
use Laravel\Passport\RefreshTokenRepository;
use Laravel\Passport\TokenRepository;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerPassportSingletons();
    }

    public function boot(): void
    {
        $this->configureCommands();
        $this->configureModels();
        $this->configureUrl();
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

        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url')."/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });

//        RedirectIfAuthenticated::redirectUsing(function () {
//            return env('FRONTEND_URL');
//        });
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

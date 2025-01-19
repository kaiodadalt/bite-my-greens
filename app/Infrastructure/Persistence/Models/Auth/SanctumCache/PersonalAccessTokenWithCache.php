<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Models\Auth\SanctumCache;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

/**
 * @property string $token
 */
final class PersonalAccessTokenWithCache extends PersonalAccessToken
{
    public static function findToken($token): ?self // @pest-ignore-type
    {
        $token = self::extractTokenFromString($token);
        $hashed_token = Hash::make($token);

        $cached_token = Cache::remember(
            "personal-access-token:$hashed_token",
            now()->addDays(30),
            fn () => parent::findToken($token)
        );

        if (! $cached_token || ! Hash::check($cached_token->token, $hashed_token)) {
            return null;
        }

        return $cached_token;
    }

    public static function boot(): void
    {
        parent::boot();

        // Update cache on token update event
        self::updating(function (self $personal_access_token): void {});

        self::deleting(function (self $personal_access_token): void {
            $hashed_token = Hash::make($personal_access_token->token);
            Cache::forget("personal-access-token:{$hashed_token}");
            Cache::forget("personal-access-token:{$hashed_token}:tokenable");
        });
    }

    public function tokenable(): Attribute
    {
        return Attribute::make(
            get: fn ($_, $attributes) => Cache::remember( // @pest-ignore-type
                'personal-access-token:'.Hash::make($attributes['token']).':tokenable',
                now()->addDays(30),
                fn () => parent::tokenable()
            )
        );
    }

    private static function extractTokenFromString(string $token_string): string
    {
        return match (true) {
            str_contains($token_string, '|') => explode('|', $token_string, 2)[1],
            default => $token_string,
        };
    }
}

<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Repositories\PassportCache;

use Illuminate\Support\Facades\Config;
use Laravel\Passport\Passport;
use Laravel\Passport\RefreshToken;
use Laravel\Passport\RefreshTokenRepository;

final class RefreshTokenRepositoryWithCache extends RefreshTokenRepository
{
    public function find($id): ?RefreshToken // @pest-ignore-type
    {
        return cache()->remember(
            $this->createKey($id),
            now()->addDays(30),
            fn () => parent::find($id)
        );
    }

    public function revokeRefreshToken($id): void // @pest-ignore-type
    {
        cache()->forget($this->createKey($id));
        parent::revokeRefreshToken($id);
    }

    public function revokeRefreshTokensByAccessTokenId($tokenId): void // @pest-ignore-type
    {
        Passport::refreshToken()
            ->query()
            ->where('access_token_id', $tokenId)
            ->get()
            ->each(fn (RefreshToken $token) => cache()->forget($this->createKey($token->id)));
        parent::revokeRefreshTokensByAccessTokenId($tokenId);
    }

    private function createKey($id): string // @pest-ignore-type
    {
        return sprintf('%s:%s', Config::string('passport.refresh_token_cache_prefix'), $id);
    }
}

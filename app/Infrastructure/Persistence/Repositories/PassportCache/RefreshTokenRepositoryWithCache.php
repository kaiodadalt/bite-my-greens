<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Repositories\PassportCache;

use Laravel\Passport\Passport;
use Laravel\Passport\RefreshToken;
use Laravel\Passport\RefreshTokenRepository;

class RefreshTokenRepositoryWithCache extends RefreshTokenRepository
{
    public function find($id): ?RefreshToken
    {
        return cache()->remember(
            $this->createKey($id),
            now()->addDays(30),
            fn() => parent::find($id)
        );
    }

    public function revokeRefreshToken($id): void
    {
        cache()->forget($this->createKey($id));
        parent::revokeRefreshToken($id);
    }

    public function revokeRefreshTokensByAccessTokenId($tokenId): void
    {
        Passport::refreshToken()
            ->query()
            ->where('access_token_id', $tokenId)
            ->get()
            ->each(fn(RefreshToken $token) => cache()->forget($this->createKey($token->id)));
        parent::revokeRefreshTokensByAccessTokenId($tokenId);
    }

    protected function createKey($id): string
    {
        return sprintf('%s:%s', env('PASSPORT_REFRESH_TOKEN_CACHE_PREFIX', 'passport:refresh-token'), $id);
    }
}

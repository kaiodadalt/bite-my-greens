<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Repositories\PassportCache;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Laravel\Passport\Token;
use Laravel\Passport\TokenRepository;

final class TokenRepositoryWithCache extends TokenRepository
{
    public function find($id): ?Token // @pest-ignore-type
    {
        return cache()->remember(
            $this->createKey($id),
            now()->addDays(15),
            fn () => parent::find($id)
        );
    }

    public function findForUser($id, $userId): ?Token // @pest-ignore-type
    {
        return cache()->remember(
            $this->createKey($id),
            now()->addDays(15),
            fn () => parent::findForUser($id, $userId)
        );
    }

    public function forUser($userId): Collection // @pest-ignore-type
    {
        return cache()->remember(
            $this->createKey($userId),
            now()->addDays(15),
            fn () => parent::forUser($userId)
        );
    }

    public function getValidToken($user, $client): ?Token // @pest-ignore-type
    {
        return cache()->remember(
            $this->createKey($user->getKey().$client->getKey()),
            now()->addDays(15),
            fn () => parent::getValidToken($user, $client)
        );
    }

    public function revokeAccessToken($id): mixed // @pest-ignore-type
    {
        cache()->forget($this->createKey($id));

        return parent::revokeAccessToken($id);
    }

    private function createKey($id): string // @pest-ignore-type
    {
        return sprintf('%s:%s', Config::string('passport.token_cache_prefix'), $id);
    }
}

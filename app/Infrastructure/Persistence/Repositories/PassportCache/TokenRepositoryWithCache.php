<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Repositories\PassportCache;

use Illuminate\Support\Collection;
use Laravel\Passport\Token;
use Laravel\Passport\TokenRepository;

class TokenRepositoryWithCache extends TokenRepository
{
    public function find($id): ?Token
    {
        return cache()->remember(
            $this->createKey($id),
            now()->addDays(15),
            fn() => parent::find($id)
        );
    }

    public function findForUser($id, $userId): ?Token
    {
        return cache()->remember(
            $this->createKey($id),
            now()->addDays(15),
            fn() => parent::findForUser($id, $userId)
        );
    }

    public function forUser($userId): Collection
    {
        return cache()->remember(
            $this->createKey($userId),
            now()->addDays(15),
            fn() => parent::forUser($userId)
        );
    }

    public function getValidToken($user, $client): ?Token
    {
        return cache()->remember(
            $this->createKey($user->getKey() . $client->getKey()),
            now()->addDays(15),
            fn() => parent::getValidToken($user, $client)
        );
    }

    public function revokeAccessToken($id): mixed
    {
        cache()->forget($this->createKey($id));
        return parent::revokeAccessToken($id);
    }

    protected function createKey($id): string
    {
        return sprintf('%s:%s', env('PASSPORT_TOKEN_CACHE_PREFIX', 'passport:token'), $id);
    }
}

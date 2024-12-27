<?php

namespace App\Repositories\PassportCache;

use Laravel\Passport\Client;
use Laravel\Passport\ClientRepository;

class ClientRepositoryCache extends ClientRepository
{
    public function find($id): ?Client
    {
        return cache()->remember(
            $this->createKey($id),
            now()->addDays(30),
            fn() => parent::find($id)
        );
    }

    protected function createKey(int|string $id): string
    {
        return sprintf('%s:%s', env('PASSPORT_CLIENT_CACHE_PREFIX', 'passport:client-token'), $id);
    }
}

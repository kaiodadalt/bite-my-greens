<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Repositories\PassportCache;

use Illuminate\Support\Facades\Config;
use Laravel\Passport\Client;
use Laravel\Passport\ClientRepository;

final class ClientRepositoryWithCache extends ClientRepository
{
    public function find($id): ?Client
    {
        return cache()->remember(
            $this->createKey($id),
            now()->addDays(30),
            fn () => parent::find($id)
        );
    }

    private function createKey(int|string $id): string
    {
        return sprintf('%s:%s', Config::string('passport.client_cache_prefix'), $id);
    }
}

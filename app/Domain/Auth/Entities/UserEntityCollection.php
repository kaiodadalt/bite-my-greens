<?php

declare(strict_types=1);

namespace App\Domain\Auth\Entities;

use App\Domain\Shared\Helpers\Collection;

/**
 * @extends Collection<int, UserEntity>
 */
final class UserEntityCollection extends Collection
{
    /**
     * @param  array<UserEntity>  $users
     * */
    public function __construct(UserEntity ...$users)
    {
        parent::__construct();
        foreach ($users as $user) {
            $this->addUser($user);
        }
    }

    public function addUser(UserEntity $user): void
    {
        $this->addWithKey($user->getId(), $user);
    }

    public function findById(int $id): ?UserEntity
    {
        return $this->all()->get($id, null);
    }

    public function removeUserById(int $id): bool
    {
        if ($this->all()->hasKey($id)) {
            $this->all()->remove($id);

            return true;
        }

        return false;
    }
}

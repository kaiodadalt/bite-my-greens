<?php

declare(strict_types=1);

namespace App\Domain\ChallengeGroup\Entities;

use App\Domain\Shared\Helpers\Collection;

/**
 * @extends Collection<int, ChallengeGroupPostEntity>
 */
final class ChallengeGroupPostEntityCollection extends Collection
{
    /**
     * @param  array<ChallengeGroupPostEntity>  $posts
     * */
    public function __construct(ChallengeGroupPostEntity ...$posts)
    {
        parent::__construct();
        foreach ($posts as $post) {
            $this->addPost($post);
        }
    }

    public function addPost(ChallengeGroupPostEntity $post): void
    {
        $this->addWithKey($post->getId(), $post);
    }

    public function findById(int $id): ?ChallengeGroupPostEntity
    {
        return $this->all()->get($id, null);
    }

    public function removeById(int $id): bool
    {
        if ($this->all()->hasKey($id)) {
            $this->all()->remove($id);

            return true;
        }

        return false;
    }
}

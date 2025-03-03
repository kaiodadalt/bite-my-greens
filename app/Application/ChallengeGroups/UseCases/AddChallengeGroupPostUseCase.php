<?php

declare(strict_types=1);

namespace App\Application\ChallengeGroups\UseCases;

use App\Application\ChallengeGroups\DTO\AddChallengeGroupPostDTO;
use App\Domain\ChallengeGroup\Data\AddChallengeGroupPostData;
use App\Domain\ChallengeGroup\Exceptions\ChallengeGroupNotFoundException;
use App\Domain\ChallengeGroup\Exceptions\UserNotAllowedToPostException;

final readonly class AddChallengeGroupPostUseCase extends ChallengeGroupUseCase
{
    /**
     * @throws UserNotAllowedToPostException
     * @throws ChallengeGroupNotFoundException
     */
    public function execute(int $user_id, AddChallengeGroupPostDTO $post): void
    {
        $this->service->post(new AddChallengeGroupPostData(
            $user_id,
            $post->challenge_group_id,
            $post->description,
            $post->image,
        ));
    }
}

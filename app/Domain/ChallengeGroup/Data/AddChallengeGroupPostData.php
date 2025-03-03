<?php

declare(strict_types=1);

namespace App\Domain\ChallengeGroup\Data;

use App\Domain\Shared\ValueObjects\File;

final readonly class AddChallengeGroupPostData
{
    public function __construct(
        private int $user_id,
        private int $challenge_group_id,
        private string $description,
        private File $image,
    ) {}

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getChallengeGroupId(): int
    {
        return $this->challenge_group_id;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getImage(): File
    {
        return $this->image;
    }
}

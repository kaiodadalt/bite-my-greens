<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Repositories\ChallengeGroup;

use App\Domain\ChallengeGroup\Contracts\ChallengeGroupPostRepository;
use App\Domain\ChallengeGroup\Data\AddChallengeGroupPostData;
use App\Domain\ChallengeGroup\Entities\ChallengeGroupPostEntity;
use App\Infrastructure\Persistence\Models\ChallengeGroups\ChallengeGroupPost;
use Illuminate\Http\UploadedFile;

final class ChallengeGroupPostEloquentRepository implements ChallengeGroupPostRepository
{
    public function create(AddChallengeGroupPostData $challenge_group_post): ChallengeGroupPostEntity
    {
        $uploaded_file = new UploadedFile(
            $challenge_group_post->getImage()->getPath(),
            $challenge_group_post->getImage()->getOriginalName(),
            $challenge_group_post->getImage()->getMimeType(),
        );
        $path = $uploaded_file->store('challenge_group_posts', 'public');
        $post = ChallengeGroupPost::create([
            'challenge_group_id' => $challenge_group_post->getChallengeGroupId(),
            'user_id' => $challenge_group_post->getUserId(),
            'description' => $challenge_group_post->getDescription(),
            'image' => $path,
            'score' => null,
        ]);

        return new ChallengeGroupPostEntity(
            $post->id,
            $post->challenge_group_id,
            $post->user_id,
            $post->description,
            $post->image,
            null,
            $post->created_at,
            $post->updated_at,
        );
    }
}

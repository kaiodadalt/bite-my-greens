<?php

declare(strict_types=1);

use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;
use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntityCollection;
use App\Infrastructure\Persistence\Mappers\ChallengeGroupMapper;
use App\Infrastructure\Persistence\Models\ChallengeGroups\ChallengeGroup;
use App\Infrastructure\Persistence\Models\ChallengeGroups\ChallengeGroupPost;

it('creates a ChallengeGroupEntity using mapper', function () {
    $challenge_group = ChallengeGroup::factory()->create();
    $entity = ChallengeGroupMapper::map($challenge_group);

    expect($entity)->toBeInstanceOf(ChallengeGroupEntity::class);
});

it('creates a ChallengeGroupEntityCollection using mapper', function () {
    $challenge_group_1 = ChallengeGroup::factory()->create();
    $challenge_group_2 = ChallengeGroup::factory()->create();
    ChallengeGroupPost::factory()->create([
        'challenge_group_id' => $challenge_group_1->id,
    ]);
    $challenge_group_1->load('posts');
    $collection = ChallengeGroupMapper::mapCollection($challenge_group_1, $challenge_group_2);

    expect($collection)->toBeInstanceOf(ChallengeGroupEntityCollection::class);
});

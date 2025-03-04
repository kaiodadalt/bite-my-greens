<?php

declare(strict_types=1);

use App\Domain\ChallengeGroup\Entities\ChallengeGroupPostEntity;
use App\Domain\ChallengeGroup\Entities\ChallengeGroupPostEntityCollection;
use App\Infrastructure\Persistence\Mappers\PostMapper;
use App\Infrastructure\Persistence\Models\ChallengeGroups\ChallengeGroupPost;

it('creates a ChallengeGroupPostEntity using mapper', function () {
    $post = ChallengeGroupPost::factory()->create();
    $entity = PostMapper::map($post);

    expect($entity)->toBeInstanceOf(ChallengeGroupPostEntity::class);
});

it('creates a ChallengeGroupPostEntityCollection using mapper', function () {
    $post_1 = ChallengeGroupPost::factory()->create();
    $post_2 = ChallengeGroupPost::factory()->create();
    $collection = PostMapper::mapCollection($post_1, $post_2);

    expect($collection)->toBeInstanceOf(ChallengeGroupPostEntityCollection::class);
});

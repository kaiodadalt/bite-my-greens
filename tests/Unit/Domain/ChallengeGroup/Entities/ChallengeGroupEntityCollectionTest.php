<?php

declare(strict_types=1);

use App\Domain\Auth\Entities\UserEntityCollection;
use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntity;
use App\Domain\ChallengeGroup\Entities\ChallengeGroupEntityCollection;
use App\Domain\ChallengeGroup\Entities\ChallengeGroupPostEntityCollection;
use App\Infrastructure\Persistence\Mappers\UserMapper;
use App\Infrastructure\Persistence\Models\Auth\User;

it('creates a ChallengeGroupEntityCollection correctly', function () {
    $user = User::factory()->create();
    $challenge_group_1 = new ChallengeGroupEntity(
        $id_1 = 1,
        'test',
        now()->addMonth()->toDateTimeImmutable(),
        UserMapper::map($user),
        new UserEntityCollection(),
        new ChallengeGroupPostEntityCollection(),
        now()->toDateTimeImmutable(),
        now()->toDateTimeImmutable(),
    );

    $challenge_group_2 = new ChallengeGroupEntity(
        $id_2 = 2,
        'test',
        now()->addMonth()->toDateTimeImmutable(),
        UserMapper::map($user),
        new UserEntityCollection(),
        new ChallengeGroupPostEntityCollection(),
        now()->toDateTimeImmutable(),
        now()->toDateTimeImmutable(),
    );

    $collection = new ChallengeGroupEntityCollection($challenge_group_1, $challenge_group_2);
    expect($collection)->toBeInstanceOf(ChallengeGroupEntityCollection::class);

    $post_found = $collection->findById($id_1);
    expect($post_found)->toBe($challenge_group_1);

    $removed = $collection->removeById($id_2);
    expect($removed)->toBeTrue()
        ->and($collection->count())->toBe(1)
        ->and($collection->findById($id_2))->toBeNull();

    $removed = $collection->removeById($id_2);
    expect($removed)->toBeFalse()
        ->and($collection->contains($challenge_group_1))->toBeTrue()
        ->and($collection->contains($challenge_group_2))->toBeFalse();

    $copy = $collection->copy();
    expect($copy->count())->toBe(1);

    $copy->clear();
    expect($copy->count())->toBe(0);

    $is_empty = $collection->isEmpty();
    expect($is_empty)->toBeFalse();

    foreach ($collection as $key => $challenge_group) {
        expect($challenge_group)->toBeInstanceOf(ChallengeGroupEntity::class)
            ->and($key)->toBe($challenge_group->getId());
    }

    $array = $collection->toArray();
    expect($array)->toBeArray();

    $json = json_encode($collection);
    expect($json)->toBeString();
});

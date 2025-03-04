<?php

declare(strict_types=1);

use App\Domain\ChallengeGroup\Entities\ChallengeGroupPostEntity;
use App\Domain\ChallengeGroup\Entities\ChallengeGroupPostEntityCollection;

it('creates a ChallengeGroupPostEntityCollection correctly', function () {
    $post_1 = new ChallengeGroupPostEntity(
        $id_1 = 1,
        1,
        1,
        'Post description 1',
        'image_1.jpg',
        0,
        now()->toDateTimeImmutable(),
        now()->toDateTimeImmutable(),
    );

    $post_2 = new ChallengeGroupPostEntity(
        $id_2 = 2,
        1,
        1,
        'Post description 2',
        'image_2.jpg',
        0,
        now()->toDateTimeImmutable(),
        now()->toDateTimeImmutable(),
    );

    $collection = new ChallengeGroupPostEntityCollection($post_1, $post_2);
    expect($collection)->toBeInstanceOf(ChallengeGroupPostEntityCollection::class);

    $post_found = $collection->findById($id_1);
    expect($post_found)->toBe($post_1);

    $removed = $collection->removeById($id_2);
    expect($removed)->toBeTrue()
        ->and($collection->count())->toBe(1)
        ->and($collection->findById($id_2))->toBeNull();

    $removed = $collection->removeById($id_2);
    expect($removed)->toBeFalse()
        ->and($collection->contains($post_1))->toBeTrue()
        ->and($collection->contains($post_2))->toBeFalse();

    $copy = $collection->copy();
    expect($copy->count())->toBe(1);

    $copy->clear();
    expect($copy->count())->toBe(0);

    $is_empty = $collection->isEmpty();
    expect($is_empty)->toBeFalse();

    foreach ($collection as $key => $post) {
        expect($post)->toBeInstanceOf(ChallengeGroupPostEntity::class)
            ->and($key)->toBe($post->getId());
    }

    $array = $collection->toArray();
    expect($array)->toBeArray();

    $json = json_encode($collection);
    expect($json)->toBeString();
});

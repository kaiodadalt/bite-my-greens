<?php

declare(strict_types=1);

use App\Domain\ChallengeGroup\Data\UpdateChallengeGroupData;

it('creates a UpdateChallengeGroupData correctly', function () {
    $data = new UpdateChallengeGroupData(
        $id = 1,
        $created_by = 2,
        $name = 'Challenge group',
        $end_date = now()->addMonth()->toDateTimeImmutable()
    );

    expect($data->getId())->toBe($id)
        ->and($data->getOwnerId())->toBe($created_by)
        ->and($data->getName())->toBe($name)
        ->and($data->getEndDate())->toBe($end_date);
});

it('throws exception when creating UpdateChallengeGroupData with wrong end date', function () {
    $this->expectException(InvalidArgumentException::class);
    new UpdateChallengeGroupData(
        id: 1,
        created_by: 2,
        name: 'Challenge group',
        end_date: now()->toDateTimeImmutable()
    );
});

it('throws exception when creating UpdateChallengeGroupData with empty name', function () {
    $this->expectException(InvalidArgumentException::class);
    new UpdateChallengeGroupData(
        id: 1,
        created_by: 2,
        name: '',
        end_date: now()->addMonth()->toDateTimeImmutable()
    );
});

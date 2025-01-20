<?php

declare(strict_types=1);

use App\Domain\ChallengeGroup\Data\CreateChallengeGroupData;

it('creates a CreateChallengeGroupData correctly', function () {
    $data = new CreateChallengeGroupData(
        $name = 'Challenge group',
        $end_date = now()->addMonth()->toDateTimeImmutable(),
        $created_by = 1
    );

    expect($data->getName())->toBe($name)
        ->and($data->getEndDate())->toBe($end_date)
        ->and($data->getOwnerId())->toBe($created_by);
});

it('throws exception when creating CreateChallengeGroupData with wrong end date', function () {
    $this->expectException(InvalidArgumentException::class);
    new CreateChallengeGroupData(
        name: 'Challenge group',
        end_date: now()->toDateTimeImmutable(),
        created_by: 1
    );
});

it('throws exception when creating CreateChallengeGroupData with empty name', function () {
    $this->expectException(InvalidArgumentException::class);
    new CreateChallengeGroupData(
        name: '',
        end_date: now()->addMonth()->toDateTimeImmutable(),
        created_by: 1
    );
});

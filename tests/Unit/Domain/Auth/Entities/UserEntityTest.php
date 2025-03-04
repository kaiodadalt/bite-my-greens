<?php

declare(strict_types=1);

use App\Domain\Auth\Entities\UserEntity;

it('creates a UserEntity correctly', function () {
    $entity = new UserEntity(
        $id = 1,
        $name = 'User name',
        $email = 'test@test.com',
    );

    expect($entity->getId())->toBe($id)
        ->and($entity->getName())->toBe($name)
        ->and($entity->getEmail())->toBe($email);
});

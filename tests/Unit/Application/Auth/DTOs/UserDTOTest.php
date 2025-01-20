<?php

declare(strict_types=1);

use App\Application\Auth\DTOs\UserDTO;

it('creates a UserDTO correctly', function () {
    $dto = new UserDTO(
        id: 1,
        name: 'John Doe',
        email: 'john.doe@example.com'
    );

    expect($dto->id)->toBe(1)
        ->and($dto->email)->toBe('john.doe@example.com')
        ->and($dto->name)->toBe('John Doe');
});

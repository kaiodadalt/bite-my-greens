<?php

declare(strict_types=1);

it('allows new users to register', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    expect(auth()->check())->toBeTrue(); // Verify the user is authenticated
    $response->assertNoContent(); // Ensure no content is returned
})->group('auth', 'registration');

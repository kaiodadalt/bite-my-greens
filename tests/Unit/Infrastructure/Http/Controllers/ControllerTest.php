<?php

declare(strict_types=1);

use App\Domain\Shared\Exceptions\DomainAuthorizationException;
use App\Infrastructure\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

it('returns 403 for DomainAuthorizationException', function () {
    $controller = new class extends Controller
    {
        public function handle()
        {
            throw new DomainAuthorizationException('Unauthorized');
        }
    };

    $response = $controller->callAction('handle', []);

    expect($response->getStatusCode())->toBe(403)
        ->and($response->getContent())->toContain('Unauthorized');
});

it('returns 422 for DomainException', function () {
    $controller = new class extends Controller
    {
        public function handle()
        {
            throw new App\Domain\Shared\Exceptions\DomainException('Domain error');
        }
    };

    $response = $controller->callAction('handle', []);

    expect($response->getStatusCode())->toBe(422)
        ->and($response->getContent())->toContain('Domain error');
});

it('returns 500 for general Exception', function () {
    Log::spy();
    $controller = new class extends Controller
    {
        public function handle()
        {
            throw new Exception('General error');
        }
    };

    $response = $controller->callAction('handle', []);

    expect($response->getStatusCode())->toBe(500)
        ->and($response->getContent())->toContain('An unexpected error occurred.');
    Log::shouldHaveReceived('error')->once();
});

it('returns successful response for valid action', function () {
    $controller = new class extends Controller
    {
        public function handle()
        {
            return response()->json(['message' => 'Success'], 200);
        }
    };

    $response = $controller->callAction('handle', []);

    expect($response->getStatusCode())->toBe(200)
        ->and($response->getContent())->toContain('Success');
});

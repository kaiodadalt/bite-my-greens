<?php

declare(strict_types=1);

arch('Avoid PHP deprecated methods')->preset()->php();

arch('Avoid unsecure PHP functions')->preset()->security();

arch('Require strict types and avoid dump functions')
    ->expect('App')
    ->toUseStrictTypes()
    ->not->toUse(['die', 'dd', 'dump']);

arch('Allow models to be used only inside repositories')
    ->expect('App\Infrastructure\Persistence\Models')
    ->toBeClasses()
    ->toExtend('Illuminate\Database\Eloquent\Model')
    ->toOnlyBeUsedIn([
        'App\Infrastructure\Persistence\Models',
        'App\Infrastructure\Persistence\Repositories',
        'Database\Factories',
        'Database\Seeders',
    ])
    ->ignoring([
        'App\Infrastructure\Persistence\Models\Auth\SanctumCache\PersonalAccessTokenWithCache',
        'App\Infrastructure\Persistence\Models\Auth\BaseUser',
        'App\Infrastructure\Persistence\Models\Auth\User',
    ]);

arch('Ensure HTTP classes are scoped to the HTTP namespace')
    ->expect('App\Infrastructure\Http')
    ->toBeClasses()
    ->toOnlyBeUsedIn('App\Infrastructure\Http');

arch('Ensure UseCases are only used in Application layer and Controllers')
    ->expect('App\Application\*\\UseCases')
    ->toBeClasses()
    ->toOnlyBeUsedIn([
        'App\Application\*\\UseCases',
        'App\Infrastructure\Http\Controllers',
    ]);

arch('Ensure Domain Services are only called by UseCases in the Application layer')
    ->expect('App\Domain\*\\Services')
    ->toBeClasses()
    ->toOnlyBeUsedIn([
        'App\Application\*\\UseCases',
    ]);

arch('Ensure Domain layer does not depend on external namespaces')
    ->expect('App\Domain')
    ->toOnlyUse([
        'App\Domain',
        'PHP',
    ]);

arch('Ensure Application layer does not depend on Infrastructure layer')
    ->expect('App\Application')
    ->toOnlyUse([
        'App\Application',
        'App\Domain',
        'PHP',
    ]);

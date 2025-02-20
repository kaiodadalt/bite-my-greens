<?php

declare(strict_types=1);

use App\Infrastructure\Http\Requests\ChallengeGroup\ExitChallengeGroupRequest;
use Illuminate\Support\Facades\Validator;

it('authorizes the exit request', function () {
    $request = new ExitChallengeGroupRequest();
    expect($request->authorize())->toBeTrue();
});

it('validates the exit challenge group request', function () {
    $data = [
        'challenge_code' => 'valid_challenge_code',
    ];

    $request = new ExitChallengeGroupRequest();
    $rules = $request->rules();

    $validator = Validator::make($data, $rules);

    expect($validator->passes())->toBeTrue();
});

it('fails validation when challenge_code is missing', function () {
    $data = [];

    $request = new ExitChallengeGroupRequest();
    $rules = $request->rules();

    $validator = Validator::make($data, $rules);

    expect($validator->fails())->toBeTrue();
});

it('fails validation when challenge_code is not a string', function () {
    $data = [
        'challenge_code' => 12345,
    ];

    $request = new ExitChallengeGroupRequest();
    $rules = $request->rules();

    $validator = Validator::make($data, $rules);

    expect($validator->fails())->toBeTrue();
});

it('fails validation when challenge_code exceeds max length', function () {
    $data = [
        'challenge_code' => str_repeat('a', 81),
    ];

    $request = new ExitChallengeGroupRequest();
    $rules = $request->rules();

    $validator = Validator::make($data, $rules);

    expect($validator->fails())->toBeTrue();
});

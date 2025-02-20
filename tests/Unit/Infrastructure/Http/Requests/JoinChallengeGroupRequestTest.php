<?php

declare(strict_types=1);

use App\Infrastructure\Http\Requests\ChallengeGroup\JoinChallengeGroupRequest;
use Illuminate\Support\Facades\Validator;

it('authorizes the join request', function () {
    $request = new JoinChallengeGroupRequest();
    expect($request->authorize())->toBeTrue();
});

it('validates the join challenge group request', function () {
    $data = [
        'challenge_code' => 'valid_challenge_code',
    ];

    $request = new JoinChallengeGroupRequest();
    $rules = $request->rules();

    $validator = Validator::make($data, $rules);

    expect($validator->passes())->toBeTrue();
});

it('fails validation when challenge_code is missing', function () {
    $data = [];

    $request = new JoinChallengeGroupRequest();
    $rules = $request->rules();

    $validator = Validator::make($data, $rules);

    expect($validator->fails())->toBeTrue();
});

it('fails validation when challenge_code is not a string', function () {
    $data = [
        'challenge_code' => 12345,
    ];

    $request = new JoinChallengeGroupRequest();
    $rules = $request->rules();

    $validator = Validator::make($data, $rules);

    expect($validator->fails())->toBeTrue();
});

it('fails validation when challenge_code exceeds max length', function () {
    $data = [
        'challenge_code' => str_repeat('a', 81),
    ];

    $request = new JoinChallengeGroupRequest();
    $rules = $request->rules();

    $validator = Validator::make($data, $rules);

    expect($validator->fails())->toBeTrue();
});

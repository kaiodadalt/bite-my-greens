<?php

declare(strict_types=1);

use App\Infrastructure\Persistence\Models\Auth\User;
use App\Infrastructure\Persistence\Models\ChallengeGroups\ChallengeGroup;
use App\Infrastructure\Persistence\Models\ChallengeGroups\ChallengeGroupUser;
use Illuminate\Http\UploadedFile;

test('user can upload a challenge post', function () {
    $user = User::factory()->create();
    $challenge_group = ChallengeGroup::factory()->create([
        'created_by' => $user->id,
    ]);
    ChallengeGroupUser::factory()->create([
        'user_id' => $user->id,
        'challenge_group_id' => $challenge_group->id,
    ]);

    $this->actingAs($user);

    $response = $this->post(route('challenge-group.post', ['id' => $challenge_group->id]), [
        'description' => $description = 'This is a challenge post',
        'image' => UploadedFile::fake()->image('image.jpg'),
    ]);

    expect($response->getStatusCode())->toBe(200);

    $this->assertDatabaseHas('challenge_groups_posts', [
        'user_id' => $user->id,
        'challenge_group_id' => $challenge_group->id,
        'description' => $description,
    ]);
});

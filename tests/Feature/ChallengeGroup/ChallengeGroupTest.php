<?php

namespace Tests\Feature\ChallengeGroup;

use App\Models\Auth\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChallengeGroupTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_challenge_group(): void
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();

        $response = $this->post('/api/challenge-group', [
            'name' => 'Kaio Challenge',
            'end_date' => now()->addDays(7)->toDateString(),
        ]);

        $response->assertStatus(201);
        $response->assertJson([
            'data' => [
                'name' => 'Kaio Challenge',
                'end_date' => now()->addDays(7)->toDateString(),
            ],
        ]);
    }
}

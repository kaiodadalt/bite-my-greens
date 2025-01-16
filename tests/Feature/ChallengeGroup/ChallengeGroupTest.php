<?php
declare(strict_types=1);

namespace Tests\Feature\ChallengeGroup;

use App\Infrastructure\Persistence\Models\Auth\User;
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
            'name' => 'Kaio Challenge',
            'end_date' => now()->addDays(7)->toDateString(),
        ]);
    }

    public function test_authenticated_user_can_update_challenge_group(): void
    {
        $user = User::factory()->create();

        // Log in the user
        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();

        $response = $this->post('/api/challenge-group', [
            'name' => 'Kaio Challenge',
            'end_date' => now()->addDays(7)->toDateString(),
        ]);

        $id = $response->json('id');

        $response = $this->put('/api/challenge-group/' . $id, [
            'name' => 'Updated Challenge',
            'end_date' => now()->addDays(10)->toDateString(),
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $id,
            'name' => 'Updated Challenge',
            'end_date' => now()->addDays(10)->toDateString(),
        ]);
        $this->assertDatabaseHas('challenge_groups', [
            'id' => $id,
            'name' => 'Updated Challenge',
            'end_date' => now()->startOfDay()->addDays(10)->format('Y-m-d H:i:s'),
        ]);
    }

}

<?php

declare(strict_types=1);

namespace Database\Factories\ChallengeGroups;

use App\Infrastructure\Persistence\Models\Auth\User;
use App\Infrastructure\Persistence\Models\ChallengeGroups\ChallengeGroup;
use App\Infrastructure\Persistence\Models\ChallengeGroups\ChallengeGroupPost;
use App\Infrastructure\Persistence\Models\ChallengeGroups\ChallengeGroupUser;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ChallengeGroupUser>
 */
final class ChallengeGroupPostFactory extends Factory
{
    protected $model = ChallengeGroupPost::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::query()->inRandomOrder()->first()->id ?? User::factory(),
            'challenge_group_id' => ChallengeGroup::query()->inRandomOrder()->first()->id ?? ChallengeGroup::factory(),
            'description' => $this->faker->text(140),
            'image' => $this->faker->imageUrl(),
        ];
    }
}

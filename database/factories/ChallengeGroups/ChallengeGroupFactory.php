<?php

namespace Database\Factories\ChallengeGroups;

use App\Models\Auth\User;
use App\Models\ChallengeGroups\ChallengeGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ChallengeGroup>
 */
class ChallengeGroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'created_by' => User::query()->inRandomOrder()->first()->id ?? User::factory(),
            'name' => $this->faker->sentence(3, true),
            'end_date' => $this->faker->dateTimeBetween('now', '+1 year'),
        ];
    }
}

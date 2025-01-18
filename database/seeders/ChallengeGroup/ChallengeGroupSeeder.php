<?php

declare(strict_types=1);

namespace Database\Seeders\ChallengeGroup;

use App\Infrastructure\Persistence\Models\ChallengeGroups\ChallengeGroup;
use Illuminate\Database\Seeder;

final class ChallengeGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ChallengeGroup::factory()->count(10)->create();
    }
}

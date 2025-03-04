<?php

declare(strict_types=1);

namespace Database\Seeders\ChallengeGroup;

use App\Infrastructure\Persistence\Models\ChallengeGroups\ChallengeGroupUser;
use Illuminate\Database\Seeder;

final class ChallengeGroupUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ChallengeGroupUser::factory()->create();
    }
}

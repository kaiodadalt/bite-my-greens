<?php

declare(strict_types=1);

namespace Database\Seeders\ChallengeGroup;

use App\Infrastructure\Persistence\Models\ChallengeGroups\ChallengeGroupPost;
use Illuminate\Database\Seeder;

final class ChallengeGroupPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ChallengeGroupPost::factory()->count(5)->create();
    }
}

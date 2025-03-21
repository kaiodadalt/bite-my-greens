<?php

declare(strict_types=1);

namespace Database\Seeders;

use Database\Seeders\Auth\UserSeeder;
use Database\Seeders\ChallengeGroup\ChallengeGroupPostSeeder;
use Database\Seeders\ChallengeGroup\ChallengeGroupSeeder;
use Database\Seeders\ChallengeGroup\ChallengeGroupUserSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ChallengeGroupSeeder::class,
            ChallengeGroupUserSeeder::class,
            ChallengeGroupPostSeeder::class,
        ]);
    }
}

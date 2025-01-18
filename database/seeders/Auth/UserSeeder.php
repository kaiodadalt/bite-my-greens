<?php

declare(strict_types=1);

namespace Database\Seeders\Auth;

use App\Infrastructure\Persistence\Models\Auth\User;
use Illuminate\Database\Seeder;

final class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::factory()->count(10)->create();
    }
}

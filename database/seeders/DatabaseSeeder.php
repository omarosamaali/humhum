<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'User 1',
            'email' => 'user@user.com',
            'password' => Hash::make('o1m2r3e4l5'),
            'email_verified_at' => now(),
            'role' => 'طاه',
        ]);

        User::factory()->create([
            'name' => 'User 2',
            'email' => 'user2@user.com',
            'password' => Hash::make('o1m2r3e4l5'),
            'email_verified_at' => now(),
            'role' => 'طاه',
        ]);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('o1m2r3e4l5'),
            'email_verified_at' => now(),
            'role' => 'مدير',
        ]);
    }
}

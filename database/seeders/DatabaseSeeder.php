<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\PrioritySeeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\TaskStatusSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            RoleSeeder::class
        ]);
        User::factory()->create([
            'role_id' => 1,
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('12345678')
        ]);
        $this->call([
            PrioritySeeder::class,
            TaskStatusSeeder::class,
        ]);
    }
}

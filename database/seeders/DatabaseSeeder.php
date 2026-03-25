<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
        ]);

        User::firstOrCreate(
            ['email' => 'demo@laracuss.test'],
            [
                'username' => 'demouser',
                'password' => 'password123',
                'picture' => null,
            ]
        );

        User::factory(10)->create();
    }
}

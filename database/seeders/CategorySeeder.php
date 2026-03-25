<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();

        DB::table('categories')->upsert([
            ['name' => 'Laravel', 'slug' => 'laravel', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'PHP', 'slug' => 'php', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'JavaScript', 'slug' => 'javascript', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Database', 'slug' => 'database', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Frontend', 'slug' => 'frontend', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Backend', 'slug' => 'backend', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'DevOps', 'slug' => 'devops', 'created_at' => $now, 'updated_at' => $now],
        ], ['slug'], ['name', 'updated_at']);
    }
}

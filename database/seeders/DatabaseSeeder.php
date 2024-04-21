<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $boards = [
            [
                'stage' => 1,
                'title' => 'Board 1',
            ],
            [
                'stage' => 2,
                'title' => 'Board 2',
            ],
            [
                'stage' => 3,
                'title' => 'Board 3',
            ],
            // Add more boards as needed
        ];

        // Insert the boards into the database
        DB::table('boards')->insert($boards);

    }
}

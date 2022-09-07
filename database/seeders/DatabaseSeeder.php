<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call(TeamSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ItemSeeder::class);
        $this->call(IssueSeeder::class);
    }
}

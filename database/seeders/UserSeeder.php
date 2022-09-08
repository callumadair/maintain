<?php

namespace Database\Seeders;

use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        User::factory()->count(10)->create();
        $factory = new UserFactory;
        $factory->withPersonalTeam()->count(10)->create();
    }
}

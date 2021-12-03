<?php

namespace Database\Seeders;

use App\Models\IntakeProfile;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create an example user
        $user1 = new User;
        $user1->name = "Johnathon";
        $user1->email = "johnny@gmail.com";
        $user1->password = "pass1";
        $user1->gender = "male";
        $user1->age_category = config('constants.age_categories')[4];
        $user1->save();

        // Create a number of random users
        User::factory()->count(10)->create();
    }
}

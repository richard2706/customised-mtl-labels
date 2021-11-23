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
        $user1->name = "John";
        $user1->email = "john@gmail.com";
        $user1->password = "pass1";
        $user1->gender = "male";
        $user1->age_category = "19-64";

        // Save the user with the intake profile
        $profile1 = IntakeProfile::find(1);
        $user1->intakeProfile()->associate($profile1);
        $user1->save();
    }
}

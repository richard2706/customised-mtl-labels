<?php

namespace Database\Seeders;

use App\Models\IntakeProfile;
use App\Models\User;
use Illuminate\Database\Seeder;

class IntakeProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create basic intake profile
        $johnathonIntakeProfile = new IntakeProfile;
        $johnathonIntakeProfile->max_calories = 2100;
        $johnathonIntakeProfile->max_total_fat = 100;
        $johnathonIntakeProfile->max_saturated_fat = 40;
        $johnathonIntakeProfile->max_total_sugar = 65;
        $johnathonIntakeProfile->max_salt = 5.8;

        // Save the intake profile to the example user
        $johnathonUser = User::find(1);
        $johnathonIntakeProfile->user()->associate($johnathonUser);
        $johnathonIntakeProfile->save();

        // Create an intake profile for each user
        $allUsers = User::get()->except([1]);
        foreach ($allUsers as $user) {
            IntakeProfile::factory()->for($user)->create();
        }
    }
}

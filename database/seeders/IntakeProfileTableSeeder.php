<?php

namespace Database\Seeders;

use App\Models\IntakeProfile;
use Database\Factories\IntakeProfileFactory;
use Illuminate\Database\Seeder;

class IntakeProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Save an intake profile for the example user
        $profile1 = new IntakeProfile;
        $profile1->max_calories = 2000;
        $profile1->max_total_fat = 100;
        $profile1->max_saturated_fat = 50;
        $profile1->max_total_sugar = 65;
        $profile1->max_salt = 5.8;
        $profile1->save();

        IntakeProfile::factory()->count(15)->create();
    }
}

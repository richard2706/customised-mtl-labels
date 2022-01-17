<?php

namespace Database\Seeders;

use App\Enums\AgeCategory;
use App\Enums\Gender;
use App\Models\IntakeProfile;
use App\Models\User;
use Illuminate\Database\Seeder;
use InvalidArgumentException;

class IntakeProfileTableSeeder extends Seeder
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
        $existingUserIds = [1];
        $allRandomUsers = User::get()->except($existingUserIds);
        foreach ($allRandomUsers as $user) {
            $ageCategory = AgeCategory::ageCategoryFromString($user->age_category);
            $gender = Gender::genderFromString($user->gender);
            $defaultIntakeProfile = $ageCategory->defaultIntakeProfile($gender);
            
            $minTolerance = 1 - config('constants.customised_nutrient_boundary_factor');
            $maxTolerance = 1 + config('constants.customised_nutrient_boundary_factor');
            $calories = random_int($minTolerance * $defaultIntakeProfile['max_calories'],
                    $maxTolerance * $defaultIntakeProfile['max_calories']);
            // $protein = $this->random_decimal($minTolerance * $defaultIntakeProfile['min_protein'],
            //         $maxTolerance * $defaultIntakeProfile['min_protein']);
            $totalFat = $this->random_decimal($minTolerance * $defaultIntakeProfile['max_total_fat'],
                    $maxTolerance * $defaultIntakeProfile['max_total_fat']);
            $saturatedFat = $this->random_decimal($minTolerance * $defaultIntakeProfile['max_saturated_fat'],
                    $maxTolerance * $defaultIntakeProfile['max_saturated_fat']);
            $totalSugar = $this->random_decimal($minTolerance * $defaultIntakeProfile['max_total_sugar'],
                    $maxTolerance * $defaultIntakeProfile['max_total_sugar']);
            $salt = $this->random_decimal($minTolerance * $defaultIntakeProfile['max_salt'],
                    $maxTolerance * $defaultIntakeProfile['max_salt']);
            // $fibre = $this->random_decimal($minTolerance * $defaultIntakeProfile['min_fibre'],
            //         $maxTolerance * $defaultIntakeProfile['min_fibre']);

            IntakeProfile::factory()->state([
                'max_calories' => $calories,
                // 'min_protein' => $protein,
                'max_total_fat' => $totalFat,
                'max_saturated_fat' => $saturatedFat,
                'max_total_sugar' => $totalSugar,
                'max_salt' => $salt,
                // 'min_fibre' => $fibre,
            ])->for($user)->create();
        }
    }

    /**
     * Returns a random decimal number between min and max inclusive with the specified number of
     * decimal places.
     * 
     * @param min Minimum number which could be generated.
     * @param max Maximum number which could be generated.
     * @param decimals Number of decimal places which the generated number will have.
     */
    private function random_decimal($min, $max, $decimals=1)
    {
        if ($min > $max) {
            throw new InvalidArgumentException('Min must be less than or equal to max.');
        } else if ($decimals < 0) {
            throw new InvalidArgumentException('Number of decimals must be 0 or greater.');
        }

        $factor = pow(10, $decimals);
        return rand($min * $factor, $max * $factor) / $factor;
    }
}

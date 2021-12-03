<?php

namespace Database\Seeders;

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
            $defaultIntakeProfile = (isset($user->gender))
                ? config('constants.default_intake_profiles')[$user->age_category][$user->gender]
                : $this->get_genderless_intake_profile($user->age_category);
            
            $minTolerance = 1 - config('constants.customised_nutrient_boundary_factor');
            $maxTolerance = 1 + config('constants.customised_nutrient_boundary_factor');
            $calories = random_int($minTolerance * $defaultIntakeProfile['calories'],
                    $maxTolerance * $defaultIntakeProfile['calories']);
            // $protein = $this->random_decimal($minTolerance * $defaultIntakeProfile['protein'],
            //         $maxTolerance * $defaultIntakeProfile['protein']);
            $totalFat = $this->random_decimal($minTolerance * $defaultIntakeProfile['total_fat'],
                    $maxTolerance * $defaultIntakeProfile['total_fat']);
            $saturatedFat = $this->random_decimal($minTolerance * $defaultIntakeProfile['saturated_fat'],
                    $maxTolerance * $defaultIntakeProfile['saturated_fat']);
            $totalSugar = $this->random_decimal($minTolerance * $defaultIntakeProfile['total_sugar'],
                    $maxTolerance * $defaultIntakeProfile['total_sugar']);
            $salt = $this->random_decimal($minTolerance * $defaultIntakeProfile['salt'],
                    $maxTolerance * $defaultIntakeProfile['salt']);
            // $fibre = $this->random_decimal($minTolerance * $defaultIntakeProfile['fibre'],
            //         $maxTolerance * $defaultIntakeProfile['fibre']);

            IntakeProfile::factory()->state([
                'max_calories' => $calories,
                // 'protein' => $protein,
                'max_total_fat' => $totalFat,
                'max_saturated_fat' => $saturatedFat,
                'max_total_sugar' => $totalSugar,
                'max_salt' => $salt,
                // 'fibre' => $fibre,
            ])->for($user)->create();
        }
    }

    /**
     * Returns an intake profile which has the average values of the male and female intake
     * profiles for the given age category.
     * 
     * @return array Average intake profile for given age category.
     */
    private function get_genderless_intake_profile($age_category)
    {
        if (!in_array($age_category, config('constants.age_categories'))) {
            throw new InvalidArgumentException('Age category does not exist.');
        }

        $maleIntakeProfile = config('constants.default_intake_profiles')[$age_category]['male'];
        $femaleIntakeProfile = config('constants.default_intake_profiles')[$age_category]['female'];

        $avgEnergyKcal = ($maleIntakeProfile['calories'] + $femaleIntakeProfile['calories']) / 2;
        $avgProtein = ($maleIntakeProfile['protein'] + $femaleIntakeProfile['protein']) / 2;
        $avgTotalfat = ($maleIntakeProfile['total_fat'] + $femaleIntakeProfile['total_fat']) / 2;
        $avgSatFat = ($maleIntakeProfile['saturated_fat'] + $femaleIntakeProfile['saturated_fat']) / 2;
        $avgTotalSugar = ($maleIntakeProfile['total_sugar'] + $femaleIntakeProfile['total_sugar']) / 2;
        $avgSalt = ($maleIntakeProfile['salt'] + $femaleIntakeProfile['salt']) / 2;
        $avgFibre = ($maleIntakeProfile['fibre'] + $femaleIntakeProfile['fibre']) / 2;

        return [
            'calories' => $avgEnergyKcal,
            'protein' => $avgProtein,
            'total_fat' => $avgTotalfat,
            'saturated_fat' => $avgSatFat,
            'total_sugar' => $avgTotalSugar,
            'salt' => $avgSalt,
            'fibre' => $avgFibre,
        ];
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

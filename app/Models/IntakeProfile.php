<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

class IntakeProfile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'max_calories',
        'max_total_fat',
        'max_saturated_fat',
        'max_total_sugar',
        'max_salt',
    ];

    /**
     * Gets the user who has this intake profile.
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Returns an intake profile which has the average values of the male and female intake
     * profiles for the given age category.
     * 
     * @param $ageCategory Age category for which to get the default profile
     * @return array Average intake profile for given age category.
     */
    public static function get_default_intake_profile($ageCategory)
    {
        if (!in_array($ageCategory, config('constants.age_categories'))) {
            throw new InvalidArgumentException('Age category does not exist.');
        }

        $maleIntake = config('constants.default_intake_profiles')[$ageCategory]['male'];
        $femaleIntake = config('constants.default_intake_profiles')[$ageCategory]['female'];

        $avgEnergyKcal = ($maleIntake['max_calories'] + $femaleIntake['max_calories']) / 2;
        // $avgProtein = ($maleIntake['min_protein'] + $femaleIntake['min_protein']) / 2;
        $avgTotalfat = ($maleIntake['max_total_fat'] + $femaleIntake['max_total_fat']) / 2;
        $avgSatFat = ($maleIntake['max_saturated_fat'] + $femaleIntake['max_saturated_fat']) / 2;
        $avgTotalSugar = ($maleIntake['max_total_sugar'] + $femaleIntake['max_total_sugar']) / 2;
        $avgSalt = ($maleIntake['max_salt'] + $femaleIntake['max_salt']) / 2;
        // $avgFibre = ($maleIntake['min_fibre'] + $femaleIntake['min_fibre']) / 2;

        return [
            'max_calories' => $avgEnergyKcal,
            // 'min_protein' => $avgProtein,
            'max_total_fat' => $avgTotalfat,
            'max_saturated_fat' => $avgSatFat,
            'max_total_sugar' => $avgTotalSugar,
            'max_salt' => $avgSalt,
            // 'min_fibre' => $avgFibre,
        ];
    }
}

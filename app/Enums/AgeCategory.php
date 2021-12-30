<?php

namespace App\Enums;

use InvalidArgumentException;

enum AgeCategory: String
{
    case FOUR_TO_SIX = '4-6';
    case SEVEN_TO_TEN = '7-10';
    case ELEVEN_TO_FOURTEEN = '11-14';
    case FIFTEEN_TO_EIGHTEEN = '15-18';
    case NINETEEN_TO_SIXTY_FOUR = '19-64';
    case SIXTY_FIVE_TO_SEVENTY_FOUR = '65-74';
    case SEVENTY_FIVE_PLUS = '75+';

    public const DEFAULT = self::NINETEEN_TO_SIXTY_FOUR;

    /**
     * Returns the age category from the given value.
     */
    public static function ageCategoryFromString($string)
    {
        foreach (self::cases() as $case) {
            if (strcmp($case->value, $string) == 0) {
                return $case;
            }
        }
        throw new InvalidArgumentException('"' . $string . '" does not match a valid age category.');
    }

    /**
     * Gets the intake profile based on the gender.
     */
    public function intakeProfile(Gender $gender)
    {
        if ($gender != Gender::UNSPECIFIED) {
            return $this->genderedIntakeProfile($gender);
        } else {
            return [
                'max_calories' => $this->ungenderedCategoryIntake('max_calories'),
                'min_protein' => $this->ungenderedCategoryIntake('min_protein'),
                'max_total_fat' => $this->ungenderedCategoryIntake('max_total_fat'),
                'max_saturated_fat' => $this->ungenderedCategoryIntake('max_saturated_fat'),
                'max_total_sugar' => $this->ungenderedCategoryIntake('max_total_sugar'),
                'max_salt' => $this->ungenderedCategoryIntake('max_salt'),
                'min_fibre' => $this->ungenderedCategoryIntake('min_fibre'),
            ];
        }
    }

    /**
     * Gets the maximum intake for the given category.
     */
    public function maxCategoryIntake(Gender $gender, $category)
    {
        $multiplier = 1 + config('constants.customised_nutrient_boundary_factor');
        return round($this->intakeProfile($gender)[$category] * $multiplier);
    }

    /**
     * Gets the minimum intake for the given category.
     */
    public function minCategoryIntake(Gender $gender, $category)
    {
        $multiplier = 1 - config('constants.customised_nutrient_boundary_factor');
        return round($this->intakeProfile($gender)[$category] * $multiplier);
    }

    /**
     * Gets the intake profile for a specific the gender.
     */
    private function genderedIntakeProfile(Gender $gender)
    {
        switch ($gender) {
            case Gender::FEMALE:
                return match($this) {
                    self::FOUR_TO_SIX => [
                        'max_calories' => 1378,
                        'min_protein' => 19.7,
                        'max_total_fat' => 54,
                        'max_saturated_fat' => 17,
                        'max_total_sugar' => 62,
                        'max_salt' => 3,
                        'min_fibre' => 17.5,
                    ],
                    self::SEVEN_TO_TEN => [
                        'max_calories' => 1703,
                        'min_protein' => 28.3,
                        'max_total_fat' => 66,
                        'max_saturated_fat' => 21,
                        'max_total_sugar' => 76.6,
                        'max_salt' => 5,
                        'min_fibre' => 20,
                    ],
                    self::ELEVEN_TO_FOURTEEN => [
                        'max_calories' => 2000,
                        'min_protein' => 41.2,
                        'max_total_fat' => 78,
                        'max_saturated_fat' => 24,
                        'max_total_sugar' => 90,
                        'max_salt' => 6,
                        'min_fibre' => 25,
                    ],
                    self::FIFTEEN_TO_EIGHTEEN => [
                        'max_calories' => 2000,
                        'min_protein' => 45,
                        'max_total_fat' => 78,
                        'max_saturated_fat' => 24,
                        'max_total_sugar' => 90,
                        'max_salt' => 6,
                        'min_fibre' => 30,
                    ],
                    self::NINETEEN_TO_SIXTY_FOUR => [
                        'max_calories' => 2000,
                        'min_protein' => 45,
                        'max_total_fat' => 78,
                        'max_saturated_fat' => 24,
                        'max_total_sugar' => 90,
                        'max_salt' => 6,
                        'min_fibre' => 30,
                    ],
                    self::SIXTY_FIVE_TO_SEVENTY_FOUR => [
                        'max_calories' => 1912,
                        'min_protein' => 46.5,
                        'max_total_fat' => 74,
                        'max_saturated_fat' => 23,
                        'max_total_sugar' => 86,
                        'max_salt' => 6,
                        'min_fibre' => 30,
                    ],
                    self::SEVENTY_FIVE_PLUS => [
                        'max_calories' => 1840,
                        'min_protein' => 46.5,
                        'max_total_fat' => 72,
                        'max_saturated_fat' => 23,
                        'max_total_sugar' => 82.8,
                        'max_salt' => 6,
                        'min_fibre' => 30,
                    ],
                };
            
            case Gender::MALE:
                return match($this) {
                    self::FOUR_TO_SIX => [
                        'max_calories' => 1482,
                        'min_protein' => 19.7,
                        'max_total_fat' => 58,
                        'max_saturated_fat' => 18,
                        'max_total_sugar' => 66.7,
                        'max_salt' => 3,
                        'min_fibre' => 17.5,
                    ],
                    self::SEVEN_TO_TEN => [
                        'max_calories' => 1817,
                        'min_protein' => 28.3,
                        'max_total_fat' => 71,
                        'max_saturated_fat' => 22,
                        'max_total_sugar' => 81.8,
                        'max_salt' => 5,
                        'min_fibre' => 20,
                    ],
                    self::ELEVEN_TO_FOURTEEN => [
                        'max_calories' => 2500,
                        'min_protein' => 42.1,
                        'max_total_fat' => 97,
                        'max_saturated_fat' => 31,
                        'max_total_sugar' => 90,
                        'max_salt' => 6,
                        'min_fibre' => 25,
                    ],
                    self::FIFTEEN_TO_EIGHTEEN => [
                        'max_calories' => 2500,
                        'min_protein' => 55.2,
                        'max_total_fat' => 97,
                        'max_saturated_fat' => 31,
                        'max_total_sugar' => 90,
                        'max_salt' => 6,
                        'min_fibre' => 30,
                    ],
                    self::NINETEEN_TO_SIXTY_FOUR => [
                        'max_calories' => 2500,
                        'min_protein' => 55.5,
                        'max_total_fat' => 97,
                        'max_saturated_fat' => 31,
                        'max_total_sugar' => 90,
                        'max_salt' => 6,
                        'min_fibre' => 30,
                    ],
                    self::SIXTY_FIVE_TO_SEVENTY_FOUR => [
                        'max_calories' => 2342,
                        'min_protein' => 53.3,
                        'max_total_fat' => 91,
                        'max_saturated_fat' => 29,
                        'max_total_sugar' => 90,
                        'max_salt' => 6,
                        'min_fibre' => 30,
                    ],
                    self::SEVENTY_FIVE_PLUS => [
                        'max_calories' => 2294,
                        'min_protein' => 53.3,
                        'max_total_fat' => 89,
                        'max_saturated_fat' => 28,
                        'max_total_sugar' => 90,
                        'max_salt' => 6,
                        'min_fibre' => 30,
                    ],
                };
            
            default: // If gender is unspecified
                throw new InvalidArgumentException('Gender cannot be ' . Gender::UNSPECIFIED->value);
        }
    }

    /**
     * Gets the ungendered intake amount for a particular category.
     */
    private function ungenderedCategoryIntake($category)
    {
        $femaleIntake = $this->genderedIntakeProfile(Gender::FEMALE);
        $maleIntake = $this->genderedIntakeProfile(Gender::MALE);
        return ($femaleIntake[$category] + $maleIntake[$category]) / 2;
    }
}

?>
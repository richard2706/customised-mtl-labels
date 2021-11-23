<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class IntakeProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $maxTotalFat = $this->faker->randomFloat(1, 50, 100);
        $maxSaturatedFat = $this->faker->randomFloat(1, 0.25 * $maxTotalFat, 0.5 * $maxTotalFat);

        return [
            'max_calories' => $this->faker->numberBetween(1750, 2750),
            'max_total_fat' => $maxTotalFat,
            'max_saturated_fat' => $maxTotalFat,
            'max_total_sugar' => $this->faker->randomFloat(1, 40, 60),
            'max_salt' => $this->faker->randomFloat(1, 5, 7),
        ];
    }
}

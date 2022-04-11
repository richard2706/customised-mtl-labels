<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class IntakeProfileFactory extends Factory
{
    /**
     * Define the model's default state as the adult reference intake values.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'max_calories' => 2000,
            'max_total_fat' => 70,
            'max_saturated_fat' => 20,
            'max_total_sugar' => 90,
            'max_salt' => 6,
        ];
    }
}

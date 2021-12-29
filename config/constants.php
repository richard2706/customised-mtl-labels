<?php

return [
    'default_intake_profiles' => [
        '4-6' => [
            'male' => [
                'max_calories' => 1482,
                'min_protein' => 19.7,
                'max_total_fat' => 58,
                'max_saturated_fat' => 18,
                'max_total_sugar' => 66.7,
                'max_salt' => 3,
                'min_fibre' => 17.5,
            ],
            'female' => [
                'max_calories' => 1378,
                'min_protein' => 19.7,
                'max_total_fat' => 54,
                'max_saturated_fat' => 17,
                'max_total_sugar' => 62,
                'max_salt' => 3,
                'min_fibre' => 17.5,
            ],
        ],
        '7-10' => [
            'male' => [
                'max_calories' => 1817,
                'min_protein' => 28.3,
                'max_total_fat' => 71,
                'max_saturated_fat' => 22,
                'max_total_sugar' => 81.8,
                'max_salt' => 5,
                'min_fibre' => 20,
            ],
            'female' => [
                'max_calories' => 1703,
                'min_protein' => 28.3,
                'max_total_fat' => 66,
                'max_saturated_fat' => 21,
                'max_total_sugar' => 76.6,
                'max_salt' => 5,
                'min_fibre' => 20,
            ],
        ],
        '11-14' => [
            'male' => [
                'max_calories' => 2500,
                'min_protein' => 42.1,
                'max_total_fat' => 97,
                'max_saturated_fat' => 31,
                'max_total_sugar' => 90,
                'max_salt' => 6,
                'min_fibre' => 25,
            ],
            'female' => [
                'max_calories' => 2000,
                'min_protein' => 41.2,
                'max_total_fat' => 78,
                'max_saturated_fat' => 24,
                'max_total_sugar' => 90,
                'max_salt' => 6,
                'min_fibre' => 25,
            ],
        ],
        '15-18' => [
            'male' => [
                'max_calories' => 2500,
                'min_protein' => 55.2,
                'max_total_fat' => 97,
                'max_saturated_fat' => 31,
                'max_total_sugar' => 90,
                'max_salt' => 6,
                'min_fibre' => 30,
            ],
            'female' => [
                'max_calories' => 2000,
                'min_protein' => 45,
                'max_total_fat' => 78,
                'max_saturated_fat' => 24,
                'max_total_sugar' => 90,
                'max_salt' => 6,
                'min_fibre' => 30,
            ],
        ],
        '19-64' => [
            'male' => [
                'max_calories' => 2500,
                'min_protein' => 55.5,
                'max_total_fat' => 97,
                'max_saturated_fat' => 31,
                'max_total_sugar' => 90,
                'max_salt' => 6,
                'min_fibre' => 30,
            ],
            'female' => [
                'max_calories' => 2000,
                'min_protein' => 45,
                'max_total_fat' => 78,
                'max_saturated_fat' => 24,
                'max_total_sugar' => 90,
                'max_salt' => 6,
                'min_fibre' => 30,
            ],
        ],
        '65-74' => [
            'male' => [
                'max_calories' => 2342,
                'min_protein' => 53.3,
                'max_total_fat' => 91,
                'max_saturated_fat' => 29,
                'max_total_sugar' => 90,
                'max_salt' => 6,
                'min_fibre' => 30,
            ],
            'female' => [
                'max_calories' => 1912,
                'min_protein' => 46.5,
                'max_total_fat' => 74,
                'max_saturated_fat' => 23,
                'max_total_sugar' => 86,
                'max_salt' => 6,
                'min_fibre' => 30,
            ],
        ],
        '75+' => [
            'male' => [
                'max_calories' => 2294,
                'min_protein' => 53.3,
                'max_total_fat' => 89,
                'max_saturated_fat' => 28,
                'max_total_sugar' => 90,
                'max_salt' => 6,
                'min_fibre' => 30,
            ],
            'female' => [
                'max_calories' => 1840,
                'min_protein' => 46.5,
                'max_total_fat' => 72,
                'max_saturated_fat' => 23,
                'max_total_sugar' => 82.8,
                'max_salt' => 6,
                'min_fibre' => 30,
            ],
        ],
    ],

    /* Maximum proportion by which a user can customise their personal daily intake amount by for each nutrient. */
    'customised_nutrient_boundary_factor' => 0.33,
];

?>
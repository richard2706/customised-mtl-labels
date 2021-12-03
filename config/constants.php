<?php

return [
    'age_categories' => ['4-6', '7-10', '11-14', '15-18', '19-64', '65-74', '75+'],

    'default_intake_profiles' => [
        '4-6' => [
            'male' => [
                'calories' => 1482,
                'protein' => 19.7,
                'total_fat' => 58,
                'saturated_fat' => 18,
                'total_sugar' => 66.7,
                'salt' => 3,
                'fibre' => 17.5,
            ],
            'female' => [
                'calories' => 1378,
                'protein' => 19.7,
                'total_fat' => 54,
                'saturated_fat' => 17,
                'total_sugar' => 62,
                'salt' => 3,
                'fibre' => 17.5,
            ],
        ],
        '7-10' => [
            'male' => [
                'calories' => 1817,
                'protein' => 28.3,
                'total_fat' => 71,
                'saturated_fat' => 22,
                'total_sugar' => 81.8,
                'salt' => 5,
                'fibre' => 20,
            ],
            'female' => [
                'calories' => 1703,
                'protein' => 28.3,
                'total_fat' => 66,
                'saturated_fat' => 21,
                'total_sugar' => 76.6,
                'salt' => 5,
                'fibre' => 20,
            ],
        ],
        '11-14' => [
            'male' => [
                'calories' => 2500,
                'protein' => 42.1,
                'total_fat' => 97,
                'saturated_fat' => 31,
                'total_sugar' => 90,
                'salt' => 6,
                'fibre' => 25,
            ],
            'female' => [
                'calories' => 2000,
                'protein' => 41.2,
                'total_fat' => 78,
                'saturated_fat' => 24,
                'total_sugar' => 90,
                'salt' => 6,
                'fibre' => 25,
            ],
        ],
        '15-18' => [
            'male' => [
                'calories' => 2500,
                'protein' => 55.2,
                'total_fat' => 97,
                'saturated_fat' => 31,
                'total_sugar' => 90,
                'salt' => 6,
                'fibre' => 30,
            ],
            'female' => [
                'calories' => 2000,
                'protein' => 45,
                'total_fat' => 78,
                'saturated_fat' => 24,
                'total_sugar' => 90,
                'salt' => 6,
                'fibre' => 30,
            ],
        ],
        '19-64' => [
            'male' => [
                'calories' => 2500,
                'protein' => 55.5,
                'total_fat' => 97,
                'saturated_fat' => 31,
                'total_sugar' => 90,
                'salt' => 6,
                'fibre' => 30,
            ],
            'female' => [
                'calories' => 2000,
                'protein' => 45,
                'total_fat' => 78,
                'saturated_fat' => 24,
                'total_sugar' => 90,
                'salt' => 6,
                'fibre' => 30,
            ],
        ],
        '65-74' => [
            'male' => [
                'calories' => 2342,
                'protein' => 53.3,
                'total_fat' => 91,
                'saturated_fat' => 29,
                'total_sugar' => 90,
                'salt' => 6,
                'fibre' => 30,
            ],
            'female' => [
                'calories' => 1912,
                'protein' => 46.5,
                'total_fat' => 74,
                'saturated_fat' => 23,
                'total_sugar' => 86,
                'salt' => 6,
                'fibre' => 30,
            ],
        ],
        '75+' => [
            'male' => [
                'calories' => 2294,
                'protein' => 53.3,
                'total_fat' => 89,
                'saturated_fat' => 28,
                'total_sugar' => 90,
                'salt' => 6,
                'fibre' => 30,
            ],
            'female' => [
                'calories' => 1840,
                'protein' => 46.5,
                'total_fat' => 72,
                'saturated_fat' => 23,
                'total_sugar' => 82.8,
                'salt' => 6,
                'fibre' => 30,
            ],
        ],
    ],

    /* Maximum proportion by which a user can customise their personal daily intake amount by for each nutrient. */
    'customised_nutrient_boundary_factor' => 0.33,
];

?>
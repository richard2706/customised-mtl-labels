<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;
use OpenFoodFacts;

class ProductLabel extends Component
{
    /** Whether there is sufficient data to generate the label. */
    public $labelSuccessful;

    /** Name of the product. */
    public $productName;

    /** Barcode number of the product. */
    public $barcode;

    /** Size of each portion of the product. */
    public $portionSize;

    /** Nutrition values per portion or 100g/ml */
    public $nutrientValues;

    /** Percentages of user's intake for each nutrient. */
    public $percentageIntakes;

    /** Colour category for each nutrient. */
    public $nutrientColourStyles;

    /** Energy values per 100 g/ml */
    public $energyKJPer100;
    public $energyKcalPer100;

    /** Units for each nutrition value. */
    public $energyKJUnits;
    public $energyKcalUnits;
    public $productUnits;

    /**
     * Create a new product label component instance. Note that the barcode is assumed to be valid,
     * since validation should be performed in a controller.
     *
     * @return void
     */
    public function __construct($barcode)
    {
        $this->barcode = $barcode;
        $product = OpenFoodFacts::barcode($barcode);
        $this->productName = array_key_exists('product_name', $product) ? $product['product_name'] : 'Unkown Product';

        // Work out product units
        $this->productUnits = array_key_exists('serving_size', $product)
            && strcmp(substr($product['serving_size'], -2), 'ml') == 0
            ? 'ml' : 'g';

        $per100Keys = ['energy-kj_100g', 'energy-kcal_100g', 'fat_100g', 'saturated-fat_100g', 'sugars_100g', 'salt_100g'];
        $per100Exists = $this->count_array_keys($per100Keys, $product['nutriments']) >= 4;
        if ($per100Exists) {
            $this->labelSuccessful = true;

            // Find nutrition values per 100g/ml
            $allLabelKeys = ['energy-kj', 'energy-kcal', 'fat', 'saturated-fat', 'sugars', 'salt'];
            foreach ($allLabelKeys as $key) {
                $this->nutrientValues[$key] = array_key_exists($key, $product['nutriments']) ? floatval($product['nutriments'][$key]) : null;
            }

            // Determine colour category for each nutrient (based on per 100g info)
            $currentUser = Auth::user();
            $userBoundaries = $currentUser ? [
                $allLabelKeys[2] => [ // fat
                    'med' => $currentUser->intakeProfile->med_total_fat_boundary,
                    'high' => $currentUser->intakeProfile->high_total_fat_boundary,
                ],
                $allLabelKeys[3] => [ // saturated fat
                    'med' => $currentUser->intakeProfile->med_saturated_fat_boundary,
                    'high' => $currentUser->intakeProfile->high_saturated_fat_boundary,
                ],
                $allLabelKeys[4] => [ // sugars
                    'med' => $currentUser->intakeProfile->med_total_sugar_boundary,
                    'high' => $currentUser->intakeProfile->high_total_sugar_boundary,
                ],
                $allLabelKeys[5] => [ // salt
                    'med' => $currentUser->intakeProfile->med_salt_boundary,
                    'high' => $currentUser->intakeProfile->high_salt_boundary,
                ]
            ] : [
                $allLabelKeys[2] => [ // fat
                    'med' => 3,
                    'high' => 17.5,
                ],
                $allLabelKeys[3] => [ // saturated fat
                    'med' => 1.5,
                    'high' => 5,
                ],
                $allLabelKeys[4] => [ // sugars
                    'med' => 5,
                    'high' => 22.5,
                ],
                $allLabelKeys[5] => [ // salt
                    'med' => 0.3,
                    'high' => 1.5,
                ]
            ];

            foreach (array_slice($allLabelKeys, -4) as $nutrient) {
                if (is_null($this->nutrientValues[$nutrient])) {
                    $this->nutrientColourStyles[$nutrient] = 'bg-white'; // White

                } else if ($this->nutrientValues[$nutrient] < $userBoundaries[$nutrient]['med']) {
                    $this->nutrientColourStyles[$nutrient] = 'bg-nutrient-low'; // Green

                } else if ($this->nutrientValues[$nutrient] < $userBoundaries[$nutrient]['high']) {
                    $this->nutrientColourStyles[$nutrient] = 'bg-nutrient-med'; // Amber

                } else {
                    $this->nutrientColourStyles[$nutrient] = 'bg-nutrient-high text-white'; // Red
                }
            }

            // Adjust label values for specified number of portions
            $numPortions = 1;
            $this->portionSize = array_key_exists('serving_size', $product) ? floatval($product['serving_size']) : 100;
            foreach ($this->nutrientValues as $key => $value) {
                if (!is_null($value)) {
                    $this->nutrientValues[$key] *= $numPortions * $this->portionSize / 100;
                }
            }

            // Get energy values per 100g/ml
            $this->energyKJPer100 = array_key_exists('energy-kj_100g', $product['nutriments']) ? $product['nutriments']['energy-kj_100g'] : null;
            $this->energyKcalPer100 = array_key_exists('energy-kcal_100g', $product['nutriments']) ? $product['nutriments']['energy-kcal_100g'] : null;
            $this->energyKJUnits = array_key_exists('energy-kj_unit', $product['nutriments']) ? $product['nutriments']['energy-kj_unit'] : 'kJ';
            $this->energyKcalUnits = array_key_exists('energy-kcal_unit', $product['nutriments']) ? $product['nutriments']['energy-kcal_unit'] : 'kcal';

            // Calculate percentage of user's customised intake, or government reference intake if user not logged in
            $userIntake = $currentUser ? [
                $allLabelKeys[1] => $currentUser->intakeProfile->max_calories,
                $allLabelKeys[2] => $currentUser->intakeProfile->max_total_fat,
                $allLabelKeys[3] => $currentUser->intakeProfile->max_saturated_fat,
                $allLabelKeys[4] => $currentUser->intakeProfile->max_total_sugar,
                $allLabelKeys[5] => $currentUser->intakeProfile->max_salt,
            ] : [
                $allLabelKeys[1] => 2000, // calories
                $allLabelKeys[2] => 70, // fat
                $allLabelKeys[3] => 20, // saturated fat
                $allLabelKeys[4] => 90, // sugars
                $allLabelKeys[5] => 6, // salt
            ];

            foreach ($this->nutrientValues as $key => $value) {
                if (!is_null($value) && strcmp($key, $allLabelKeys[0]) != 0) {
                    $this->percentageIntakes[$key] = 100 * $this->nutrientValues[$key] / $userIntake[$key];
                }
            }
        } else {
            $this->labelSuccessful = false;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.product-label');
    }

    /**
     * Returns the number of keys present in the given array. e.g. ['a'], ['a' => 1, 'b' => 2] returns 1.
     */
    private function count_array_keys(array $keys, array $array) {
        return count(array_intersect_key(array_flip($keys), $array));
    }
}

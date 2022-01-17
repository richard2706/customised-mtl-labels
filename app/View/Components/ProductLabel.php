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
            // Find nutrition values per 100g/ml
            $labelKeys = ['energy-kj', 'energy-kcal', 'fat', 'saturated-fat', 'sugars', 'salt'];
            foreach ($labelKeys as $key) {
                $this->nutrientValues[$key] = array_key_exists($key, $product['nutriments']) ? floatval($product['nutriments'][$key]) : null;
            }
            $this->labelSuccessful = true;
            
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

            // Calculate percentage of user's intake
            $currentUser = Auth::user();
            $userIntake = [
                $labelKeys[1] => $currentUser->intakeProfile->max_calories,
                $labelKeys[2] => $currentUser->intakeProfile->max_total_fat,
                $labelKeys[3] => $currentUser->intakeProfile->max_saturated_fat,
                $labelKeys[4] => $currentUser->intakeProfile->max_total_sugar,
                $labelKeys[5] => $currentUser->intakeProfile->max_salt,
            ];
            foreach ($this->nutrientValues as $key => $value) {
                if (!is_null($value) && strcmp($key, $labelKeys[0]) != 0) {
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

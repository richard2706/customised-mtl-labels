<?php

namespace App\View\Components;

use Illuminate\View\Component;
use OpenFoodFacts;

class ProductLabel extends Component
{
    /** Whether there is sufficient data to generate the label. */
    public $labelSuccessful;

    /** Name of the product. */
    public $productName;

    /** Size of each portion of the product. */
    public $portionSize;

    /** Nutrition values per portion or 100g/ml */
    public $nutrientValues;

    /** Energy values per 100 g/ml */
    public $energyKJPer100;
    public $energyKcalPer100;

    /** Units for each nutrition value. */
    public $energyKJUnits;
    public $energyKcalUnits;
    public $productUnits;

    /** Default value for unknown values. */
    private const DEFAULT_VALUE = 'unknown';

    /**
     * Create a new product label component instance. Note that the barcode is assumed to be valid,
     * since validation should be performed in a controller.
     *
     * @return void
     */
    public function __construct($barcode)
    {
        $product = OpenFoodFacts::barcode($barcode);
        $this->productName = array_key_exists('product_name', $product) ? $product['product_name'] : self::DEFAULT_VALUE;

        // Work out product units
        $this->productUnits = array_key_exists('serving_size', $product)
            && strcmp(substr($product['serving_size'], -2), 'ml') == 0
            ? 'ml' : 'g';

        // Find nutrition values per 100g/ml
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
        } else {
            $this->labelSuccessful = false;
        }

        $this->energyKJUnits = array_key_exists('energy-kj_unit', $product['nutriments']) ? $product['nutriments']['energy-kj_unit'] : 'kJ';
        $this->energyKcalUnits = array_key_exists('energy-kcal_unit', $product['nutriments']) ? $product['nutriments']['energy-kcal_unit'] : 'kcal';
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

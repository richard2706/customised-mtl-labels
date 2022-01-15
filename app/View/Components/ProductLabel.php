<?php

namespace App\View\Components;

use Illuminate\View\Component;
use OpenFoodFacts;

class ProductLabel extends Component
{
    /** Name of the product. */
    public $productName;

    /**
     * Create a new product label component instance. Note that the barcode is assumed to be valid,
     * since validation should be performed in a controller.
     *
     * @return void
     */
    public function __construct($barcode)
    {
        $product = OpenFoodFacts::barcode($barcode);
        $this->productName = $product['product_name'];
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
}

<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MTLLabel extends Component
{
    /**  */
    public $product;

    /** Name of the product. */
    // public $productName;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($product)
    // public function __construct()
    {
        $product['test_me'] = 'TEST'; // doesn't add this key to the array, cannot access in in component
        $this->product = $product;
        // $this->productName = $product['product_name'];
        // dd($this->product);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        // $productName = $this->productName;
        // return view('components.mtl-label', ['productName' => 'TESTING']);
        return view('components.mtl-label');
    }
}

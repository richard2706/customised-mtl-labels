<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ProductLabel extends Component
{
    public $product;

    public $test;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($product)
    {
        $this->product = $product;
        $this->test = "hello";
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

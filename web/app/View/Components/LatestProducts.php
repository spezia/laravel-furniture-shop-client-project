<?php

namespace App\View\Components;

use App\Services\Product;
use Illuminate\View\Component;

class LatestProducts extends Component
{
    /**
     * The products.
     *
     * @var Collection
     */
    public $products;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Product $service)
    {
        $this->products = $service->getLatestProducts();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.latest-products');
    }
}

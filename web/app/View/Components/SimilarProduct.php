<?php

namespace App\View\Components;

use App\Services\Product;
use Illuminate\View\Component;

class SimilarProduct extends Component
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
     * @param int $category
     * @param Product $service
     *
     * @return void
     */
    public function __construct(int $category, Product $service)
    {
        $this->products = $service->getAllEnabledByCategoryId($category);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.similar-product');
    }
}

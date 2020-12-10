<?php

namespace App\View\Components;

use App\Services\Category;
use Illuminate\View\Component;
use Illuminate\Database\Eloquent\Collection;

class Categories extends Component
{
    /**
     * The categories.
     *
     * @var Collection
     */
    public $categories;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Category $categoryService)
    {
        $this->categories = $categoryService->getListActiveCategories();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.categories');
    }
}

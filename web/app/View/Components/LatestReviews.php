<?php

namespace App\View\Components;

use App\Services\Review;
use Illuminate\View\Component;

class LatestReviews extends Component
{
    /**
     * The products.
     *
     * @var Collection
     */
    public $reviews;

    /**
     * Create a new component instance.
     * 
     * @param Review $service
     *
     * @return void
     */
    public function __construct(Review $service)
    {
        $this->reviews = $service->getLatestReviews();
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.latest-reviews');
    }
}

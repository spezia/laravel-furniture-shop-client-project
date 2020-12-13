<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\Category;
use App\Services\Review;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Show Home page
     *
     * @param Category $service
     * @param Review $reviewService
     * 
     * @return View
     */
    public function home(Category $service, Review $reviewService): View
    {
        return view('front.pages.home', [
            'categoriesFirst' => $service->categoriesByOrder('asc'),
            'categoriesLast' => $service->categoriesByOrder('desc'),
            'reviews' => $reviewService->getLatestReviews(),
        ]);
    }
}

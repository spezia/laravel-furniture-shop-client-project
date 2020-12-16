<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\Category;
use App\Services\Product;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     *  Must find by slug, because of translations cannot find object automatically
     * Two routes hit this method
     * -- category slug, list products by category slug
     * -- open products page (no slugs), and use fist category to list products
     *
     * @param Product $service
     * 
     * @return Response
     */
    public function home(string $slug = null, Product $service, Category $categoryService)
    {
        $category = $slug ?
            $categoryService->fetchBySlug($slug) : $categoryService->fetchFirst();

        return view('front.product.home', [
            'category' => $category,
            'products' => $category ? $service->getWithDiscountsByCategory($category) : [], // we need pagination
            'categories' => $categoryService->fetchActiveCategoriesWithCountProducts(),
        ]);
    }

    /**
     *  Must find by slug, because of translations cannot find object automatically
     *
     * @param string $slug
     * @param Product $service
     * 
     * @return Response
     */
    public function show(string $slug, Product $service)
    {
        if (!$model = $service->fetchBySlug($slug)) {
            abort(404);
        }

        // show front page about ...
        return view('front.product.show', [
            'product' => $model,
            'collection' => \config('custom.media.product'),
        ]);
    }
}

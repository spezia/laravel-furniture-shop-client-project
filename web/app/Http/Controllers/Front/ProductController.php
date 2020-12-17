<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\Category;
use App\Services\Product;
use App\Services\Url;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     *  Must find by slug, because of translations cannot find object automatically
     * Two routes hit this method
     * -- category slug, list products by category slug
     * -- open products page (no slugs), and use fist category to list products
     *
     * @param Request $request
     * @param string $slug|null
     * @param Product $service
     * @param Category $categoryService
     * @param Url $urlService
     * 
     * @return Response
     */
    public function home(
        Request $request,
        string $slug = null,
        Product $service,
        Category $categoryService,
        Url $urlService
    ) {
        $orderBy = null;
        $selectedSort = null;
        $categories = $categoryService->fetchActiveCategoriesWithCountProducts();
        $category = $slug ? $categoryService->fetchBySlug($slug) : $categories->first();

        if ($request->has('order')) {
            $orderBy = $urlService->getOrderBy($request->get('order'));
            $selectedSort = $request->get('order');
        }

        $products = $service->getWithDiscountsByCategory($category, $orderBy);
        $products->setPath(url()->current()); // define path for custom pagination
        // append order query param on pagination links
        if ($orderBy) {
            $products->appends(['order' => $request->get('order')]);
        }

        return view('front.product.home', [
            'category' => $category,
            'products' => $products, // we need pagination
            'categories' => $categories,
            'sort' => $urlService->fetchSortOptions(),
            'selectedSort' => $selectedSort
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

        return view('front.product.show', [
            'product' => $model,
            'collection' => \config('custom.media.product'),
        ]);
    }
}

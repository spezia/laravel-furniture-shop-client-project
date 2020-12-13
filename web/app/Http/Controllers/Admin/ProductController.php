<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductInsert;
use App\Http\Requests\ProductUpdate;
use Illuminate\Http\Response;
use App\Product;
use App\Services\Category;
use App\Services\Product as ProductService;
use Illuminate\Support\Facades\Log;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Throwable;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ProductService $productService
     *
     * @return Response
     */
    public function index(ProductService $productService)
    {
        return view('admin.products.home', [
            'data' => $productService->getAll(),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @param Category $categoryServise
     *
     * @return Response
     */
    public function show(Product $product, Category $categoryServise)
    {
        return view('admin.products.view', [
            'product' => $product,
            'categories' => $categoryServise->getListCategories(),
            'isView' => true,
            'collection' => \config('custom.media.product'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Category $categoryServise
     * 
     * @return Response
     */
    public function create(Category $categoryServise)
    {
        $product = null;

        return view('admin.products.new', [
            'product' => $product,
            'categories' => $categoryServise->getListCategories()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProductInsert $request
     * @param  ProductService $productService
     *
     * @return Response|RedirectResponse
     */
    public function store(ProductInsert $request, ProductService $productService)
    {
        try {
            $productService->create($request->all());
        } catch (Throwable $e) {
            Log::error($e->getMessage());

            return back()->withInput()->with('error', 'Product has not been added.');
        }

        return redirect()->route('products.index')->with('message', 'Product has been added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @param Category $categoryServise
     *
     * @return Response
     */
    public function edit(Product $product, Category $categoryServise)
    {
        return view('admin.products.edit', [
            'product' => $product,
            'categories' => $categoryServise->getListCategories(),
            'collection' => \config('custom.media.product'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProductUpdate  $request
     * @param  Product $product
     * @param  ProductService $productService
     *
     * @return Response
     */
    public function update(ProductUpdate $request, Product $product, ProductService $productService)
    {
        try {
            $productService->update($product, $request->all());
        } catch (Throwable $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }

        return redirect()->route('products.edit', ['product' => $product->id])->with('message', 'Product has been updated successfully.');
    }

    /**
     * Destroy product
     *
     * @param ProductService $productService
     * @param Product $product
     *
     * @return Response|RedirectResponse
     */
    public function destroy(ProductService $productService, Product $product)
    {
        if ($productService->delete($product)) {
            return redirect()->route('products.index')->with('message', 'Product has been removed.');
        }

        return back()->with('error', 'Product has not been removed.');
    }

    /**
     * Destroy product
     *
     * @param Product $product
     * @param Media $media
     *
     * @return Response|RedirectResponse
     */
    public function destroyImage(Product $product, Media $image)
    {
        if ($image->delete()) {
            return redirect()->route('products.edit', ['product' => $product->id])->with('message', 'File has been removed.');
        }

        return back()->with('error', 'File has not been removed.');
    }
}

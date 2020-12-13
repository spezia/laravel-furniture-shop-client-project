<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductDiscountRequest;
use Illuminate\Http\Response;
use App\ProductDiscount;
use App\Services\Product;
use App\Services\ProductDiscount as ProductDiscountService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class ProductDiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ProductDiscountService $productDiscountService
     *
     * @return Response
     */
    public function index(ProductDiscountService $productDiscountService)
    {
        return view('admin.product-discounts.home', [
            'data' => $productDiscountService->getAll()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param ProductDiscount $productDiscount
     * @param Product $productService
     *
     * @return Response
     */
    public function show(ProductDiscount $productDiscount, Product $productService)
    {
        return view('admin.product-discounts.view', [
            'discount' => $productDiscount,
            'products' => $productService->getAllEnabled(),
            'isView' => true,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @param Product $productService
     *
     * @return Response
     */
    public function create(Product $productService)
    {
        $productDiscount = null;

        return view('admin.product-discounts.new', [
            'discount' => $productDiscount,
            'products' => $productService->getAllEnabled()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductDiscountRequest $request
     * @param ProductDiscountService $productDiscountService
     *
     * @return Response|RedirectResponse
     */
    public function store(ProductDiscountRequest $request, ProductDiscountService $productDiscountService)
    {
        try {
            $productDiscountService->create($request->all());
        } catch (Throwable $e) {
            Log::error($e->getMessage());

            return back()->withInput()->with('error', 'Discount has not been added.');
        }

        return redirect()->route('product-discounts.index')->with('message', 'Discount has been added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ProductDiscount $productDiscount
     * @param Product $productService
     *
     * @return Response
     */
    public function edit(ProductDiscount $productDiscount, Request $request, Product $productService)
    {
        return view('admin.product-discounts.edit', [
            'discount' => $productDiscount,
            'products' => $productService->getAllEnabled()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProductDiscountRequest  $request
     * @param  ProductDiscount $productDiscount
     * @param  ProductDiscountService $productDiscountService
     *
     * @return Response
     */
    public function update(ProductDiscountRequest $request, ProductDiscount $productDiscount, ProductDiscountService $productDiscountService)
    {
        try {
            $productDiscountService->update($productDiscount, $request->all());
        } catch (Throwable $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }

        return redirect()->route('product-discounts.edit', ['productDiscount' => $productDiscount])->with('message', 'Discount has been updated successfully.');
    }

    /**
     * Destroy productDiscount
     *
     * @param ProductDiscountService $productDiscountService
     * @param ProductDiscount $productDiscount
     *
     * @return Response|RedirectResponse
     */
    public function destroy(ProductDiscountService $productDiscountService, ProductDiscount $productDiscount)
    {
        if ($productDiscountService->delete($productDiscount)) {
            return redirect()->route('product-discounts.index')->with('message', 'Discount has been removed.');
        }

        return back()->with('error', 'Discount has not been removed.');
    }
}

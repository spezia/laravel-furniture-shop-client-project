<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use App\Services\Product;
use App\Services\Review;
use Illuminate\Http\JsonResponse;
use Throwable;

class ReviewController extends Controller
{
    /**
     *
     * @param ReviewRequest $request
     * @param string $slug
     * @param Review $service
     * @param Product $productService
     * 
     * @return JsonResponse
     */
    public function store(ReviewRequest $request, string $slug, Review $service, Product $productService): JsonResponse
    {
        try {
            if (!$product = $productService->fetchBySlug($slug)) {
                abort(404);
            }
            $service->create($product, $request->all());

            return response()->json([
                'status' => 1,
                'msg' => trans('custom.reviewok'),
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 0,
                'msg' => trans('custom.error'),
            ]);
        }
    }
}

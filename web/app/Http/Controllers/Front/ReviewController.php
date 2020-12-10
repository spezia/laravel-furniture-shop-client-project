<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use App\Services\Review;
use App\Services\UserEmail;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class ReviewController extends Controller
{
    /**
     *
     * @param ReviewRequest $request
     * @param Review $service
     * @param UserEmail $emailService
     * 
     * @return JsonResponse
     */
    public function store(ReviewRequest $request, Review $service, UserEmail $emailService): JsonResponse
    {
        try {
            $service->create($request->all());

            // send email to admin
            $emailService->sendReviewToAdmin($request->all());

            return response()->json([
                'status' => 1,
                'msg' => trans('custom.reviewok'),
            ]);
        } catch (Throwable $e) {
            Log::error($e->getMessage());

            return response()->json([
                'status' => 0,
                'msg' => trans('custom.error'),
            ]);
        }
    }
}

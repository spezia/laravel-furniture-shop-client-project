<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewUpdate;
use Illuminate\Http\Response;
use App\Review;
use App\Services\Review as ReviewService;
use Throwable;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ReviewService $reviewService
     *
     * @return Response
     */
    public function index(ReviewService $reviewService)
    {
        return view('admin.reviews.home', [
            'data' => $reviewService->getAll(),
            'accepted' => Review::STATUS_ACCEPTED,
            'review' => Review::STATUS_IN_REVIEW,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Review $review
     *
     * @return Response
     */
    public function show(Review $review)
    {
        return view('admin.reviews.view', [
            'review' => $review,
            'statuses' => Review::getStatuses(),
            'isView' => true,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Review $review
     *
     * @return Response
     */
    public function edit(Review $review)
    {
        return view('admin.reviews.edit', [
            'review' => $review,
            'statuses' => Review::getStatuses(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ReviewUpdate  $request
     * @param  Review $review
     * @param  ReviewService $reviewService
     *
     * @return Response
     */
    public function update(ReviewUpdate $request, Review $review, ReviewService $reviewService)
    {
        try {
            $reviewService->update($review, $request->all());
        } catch (Throwable $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }

        return redirect()->route('reviews.edit', ['review' => $review->id])->with('message', 'Review has been updated successfully.');
    }

    /**
     * Destroy review
     *
     * @param ReviewService $reviewService
     * @param Review $review
     *
     * @return Response|RedirectResponse
     */
    public function destroy(ReviewService $reviewService, Review $review)
    {
        if ($reviewService->delete($review)) {
            return redirect()->route('reviews.index')->with('message', 'Review has been removed.');
        }

        return back()->with('error', 'Review has not been removed.');
    }
}

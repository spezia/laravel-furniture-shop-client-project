<?php

namespace App\Repository;

use App\Product;
use App\Review;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class ReviewRepository
 */
class ReviewRepository
{
    /**
     * Return all reviews
     *
     * @return LengthAwarePaginator
     */
    public function fetchAll(): LengthAwarePaginator
    {
        return Review::paginate(\config('custom.reviews.show_per_review'));
    }

    /**
     * Fetch enabled reviews
     *
     * @return Collection
     */
    public function reviewsLatest(): Collection
    {
        return Review::where('status', Review::STATUS_ACCEPTED)
            ->take(10)
            ->latest()
            ->get();
    }

    /**
     * Get Review by id.
     * 
     * @param int $reviewId
     * 
     * @return Review|null
     */
    public function getById(int $reviewId): ?Review
    {
        return Review::where('id', $reviewId)->first();
    }

    /**
     * Get Review by slug.
     *
     * @param string|null $slug
     * @return Review|null
     */
    public function findBySlug(?string $slug): ?Review
    {
        return Review::where('slug', $slug)->where('is_enabled', true)->first();
    }

    /**
     * Create Review
     *
     * @param Product $product
     * @param array $data
     * 
     * @return Review
     */
    public function create(array $data): Review
    {
        $model = new Review();
        $model->fill($data);
        $model->save();

        return $model;
    }

    /**
     * Update Review
     *
     * @param Review $review
     * @param array $fields
     *
     * @return Review
     */
    public function update(Review $review, array $fields): Review
    {
        $review->fill($fields);
        $review->save();

        return $review;
    }

    /**
     * Remove Review
     *
     * @param  Review $review
     *
     * @return bool|null
     */
    public function delete(Review $review): ?bool
    {
        return $review->delete();
    }
}

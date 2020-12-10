<?php

namespace App\Services;

use App\Product;
use App\Repository\ReviewRepository;
use App\Review as AppReview;
use Illuminate\Pagination\LengthAwarePaginator;
use RuntimeException;

/**
 * Review specific functionality
 */
class Review
{
    /**
     * @var ReviewRepository
     */
    private $reviewRepository;

    /**
     * @param ReviewRepository $reviewRepository
     */
    public function __construct(ReviewRepository $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }

    /**
     * Get All Reviews
     *
     * @return LengthAwarePaginator
     */
    public function getAll(): LengthAwarePaginator
    {
        return $this->reviewRepository->fetchAll();
    }

    /**
     *
     * @param array $data
     *
     * @return AppReview
     */
    public function create(array $data): AppReview
    {
        return $this->reviewRepository->create($data);
    }

    /**
     *
     * @param AppReview $review
     * @param array $data
     *
     * @return AppReview $review
     */
    public function update(AppReview $review, array $data): AppReview
    {
        // $forUpdate = $this->matchInputModelValues($data);
        // $forUpdate['status'] = $data['status'];

        if (!$this->reviewRepository->update($review, $data)) {
            throw new RuntimeException('Review has not been updated.');
        }

        return $review;
    }

    /**
     *
     * @param AppReview $review
     *
     * @return bool|null
     */
    public function delete(AppReview $review): ?bool
    {
        return $this->reviewRepository->delete($review);
    }

    /**
     *
     * @param string|null $slug
     * 
     * @return AppReview|null
     */
    public function fetchBySlug(?string $slug): ?AppReview
    {
        return $this->reviewRepository->findBySlug($slug);
    }
}

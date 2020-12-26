<?php

namespace App\Repository;

use App\Category;
use App\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class ProductRepository
 */
class ProductRepository
{
    /**
     * Return all products (admin)
     * 
     * @param array $searchData
     *
     * @return LengthAwarePaginator
     */
    public function fetchAll(array $searchData = []): LengthAwarePaginator
    {
        $qb = Product::orderBy('is_enabled', 'desc');

        if (isset($searchData['name']) && $searchData['name']) {
            $qb->where('name', 'like', '%' . $searchData['name'] . '%');
        }

        if (isset($searchData['code']) && $searchData['code']) {
            $qb->where('code', 'like', $searchData['code'] . '%');
        }

        if (isset($searchData['category']) && $searchData['category']) {
            $qb->where('category_id', $searchData['category']);
        }

        if (isset($searchData['status'])) {
            $qb->where('is_enabled', (int) $searchData['status']);
        }

        return $qb->paginate(\config('custom.pages.show_per_page'));
    }

    /**
     * Return all products (admin - discounts page)
     *
     * @return Collection
     */
    public function getAllAsCollection(): Collection
    {
        return Product::orderBy('is_enabled', 'desc')->get();
    }

    /**
     * Fetch enabled products (admin discounts create)
     *
     * @return Collection
     */
    public function getAllEnabled(): Collection
    {
        return Product::where('is_enabled', true)
            ->whereHas('category', function ($query) {
                $query->where('is_enabled', true);
            })
            ->get();
    }

    /**
     * Fetch latest products (front page)
     *
     * @return Collection
     */
    public function getLatestProducts(): Collection
    {
        return Product::where('is_enabled', true)
            ->has('media')
            ->whereHas('category', function ($query) {
                $query->where('is_enabled', true);
            })
            ->with(['media', 'discounts'])
            ->latest()
            ->take(\config('custom.pages.latest'))
            ->get();
    }

    /**
     * Return products by category id except product id
     *
     * @param integer $id
     * @param integer $productId
     * 
     * @return Collection
     */
    public function getSimilarProduct(int $id, int $productId): Collection
    {
        return Product::where('is_enabled', true)
            ->where('category_id', $id)
            ->where('id', '!=', $productId)
            ->whereHas('category', function ($query) {
                $query->where('is_enabled', true);
            })
            ->with(['category', 'media', 'discounts'])
            ->latest()
            ->take(\config('custom.pages.latest'))
            ->get();
    }

    /**
     * Fetch products with active discounts by category (front page)
     * 
     * @param Carbon $date
     * @param Category $category
     *
     * @return Collection
     */
    public function getWithDiscountsByCategory(Carbon $date, Category $category): Collection
    {
        return Product::where('is_enabled', true)
            ->where('category_id', $category->id)
            ->whereHas('category', function ($query) {
                $query->where('is_enabled', true);
            })
            ->with(['media', 'discounts' => function ($query) use ($date) {
                $query->where('from', '<=', $date)
                    ->where('to', '>=', $date);
            }])
            ->orderBy('id', 'desc')
            ->get();
    }

    /**
     * Fetch products with active discounts (front page)
     * 
     * @param Carbon $date
     *
     * @return Collection
     */
    public function getWithDiscounts(Carbon $date): Collection
    {
        return Product::where('is_enabled', true)
            ->whereHas('discounts', function ($query) use ($date) {
                $query->where('from', '<=', $date)
                    ->where('to', '>=', $date);
            })
            ->whereHas('category', function ($query) use ($date) {
                $query->where('is_enabled', true);
            })
            ->with(['media', 'discounts' => function ($query) use ($date) {
                $query->where('from', '<=', $date)
                    ->where('to', '>=', $date);
            }])
            ->orderBy('id', 'desc')
            ->get();
    }

    /**
     * Get Product by id. (admin)
     * 
     * @param int $productId
     * 
     * @return Product|null
     */
    public function getById(int $productId): ?Product
    {
        return Product::where('id', $productId)->first();
    }

    /**
     * Get Product by slug.
     *
     * @param string|null $slug
     * @return Product|null
     */
    public function findBySlug(?string $slug): ?Product
    {
        return Product::where('slug->' . app()->getLocale(), $slug)
            ->whereHas('category', function ($query) {
                $query->where('is_enabled', true);
            })
            ->with(['media', 'category', 'discounts'])
            ->where('is_enabled', true)
            ->first();
    }

    /**
     * Create Product
     *
     * @param array $data
     * @return Product
     */
    public function create(array $data): Product
    {
        return Product::create($data);
    }

    /**
     * Update Product
     *
     * @param Product $product
     * @param array $fields
     *
     * @return Product
     */
    public function update(Product $product, array $fields): Product
    {
        $product->fill($fields);
        $product->save();

        return $product;
    }

    /**
     * Remove Product
     *
     * @param  Product $product
     *
     * @return bool|null
     */
    public function delete(Product $product): ?bool
    {
        return $product->delete();
    }
}

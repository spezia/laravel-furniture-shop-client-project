<?php

namespace App\Repository;

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
     * Return all products
     *
     * @return LengthAwarePaginator
     */
    public function fetchAll(): LengthAwarePaginator
    {
        return Product::paginate(\config('custom.pages.show_per_page'));
    }

    /**
     * Fetch enabled products
     *
     * @return Collection
     */
    public function getAllEnabled(): Collection
    {
        return Product::where('is_enabled', true)->get();
    }

    /**
     * Fetch latest products (front page)
     *
     * @return Collection
     */
    public function getLatestProducts(): Collection
    {
        return Product::where('is_enabled', true)
            ->latest()
            ->take(\config('custom.pages.latest'))
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
            ->with(['discounts' => function ($query) use ($date) {
                $query->where('from', '<=', $date)
                    ->where('to', '>=', $date);
            }])
            ->orderBy('id', 'desc')
            ->get();
    }

    /**
     * Get Product by id.
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

<?php

namespace App\Repository;

use App\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class CategoryRepository
 */
class CategoryRepository
{
    /**
     * Return all categories
     *
     * @return LengthAwarePaginator
     */
    public function fetchAll(): LengthAwarePaginator
    {
        return Category::paginate(\config('custom.pages.page'));
    }

    /**
     * Return all categories
     *
     * @return Collection
     */
    public function fetchListCategories(): Collection
    {
        return Category::all(['id', 'name']);
    }

    /**
     * Fetch 3 items for front home page sliders
     *
     * @param string $orderBy
     * 
     * @return Collection
     */
    public function getCategoriesByOrder(string $orderBy = 'asc'): Collection
    {
        return Category::where('is_enabled', true)
            ->whereHas('products', function ($query) {
                $query->where('is_enabled', true);
            })
            ->with(['products' => function ($query) {
                $query->where('is_enabled', true);
            }, 'products.media'])
            ->orderBy('id', $orderBy)
            ->take(3)
            ->get();
    }

    /**
     * Return all active categories
     *
     * @return Collection
     */
    public function fetchActiveListCategories(): Collection
    {
        return Category::select(['id', 'name', 'slug'])->where('is_enabled', true)->get();
    }

    /**
     * Return all active categories
     *
     * @return Collection
     */
    public function fetchActiveCategoriesWithCountProducts(): Collection
    {
        return Category::select(['id', 'name', 'slug'])
            ->where('is_enabled', true)
            ->withCount(['products' => function ($query) {
                $query->where('is_enabled', true);
            }])
            ->get();
    }

    /**
     * Get Category by id.
     * 
     * @param int $categoryId
     * 
     * @return Category|null
     */
    public function getById(int $categoryId): ?Category
    {
        return Category::where('id', $categoryId)->first();
    }

    /**
     * Get Category by slug.
     *
     * @param string|null $slug
     * @return Category|null
     */
    public function findBySlug(?string $slug): ?Category
    {
        return Category::where('slug->' . app()->getLocale(), $slug)->where('is_enabled', true)->first();
    }

    /**
     * Get enabled Category.
     *
     * @return Category|null
     */
    public function getEnabledCategory(): ?Category
    {
        return Category::where('is_enabled', true)->first();
    }

    /**
     * Create Category
     *
     * @param array $data
     * @return Category
     */
    public function create(array $data): Category
    {
        return Category::create($data);
    }

    /**
     * Update Category
     *
     * @param Category $category
     * @param array $fields
     *
     * @return Category
     */
    public function update(Category $category, array $fields): Category
    {
        $category->fill($fields);
        $category->save();

        return $category;
    }

    /**
     * Remove Category
     *
     * @param  Category $category
     *
     * @return bool|null
     */
    public function delete(Category $category): ?bool
    {
        return $category->delete();
    }
}

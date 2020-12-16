<?php

namespace App\Services;

use App\Category as ModelCategory;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repository\CategoryRepository;
use Illuminate\Database\Eloquent\Collection;
use RuntimeException;

/**
 * Category specific functionality
 */
class Category
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Get All Categories
     *
     * @return LengthAwarePaginator
     */
    public function getAll(): LengthAwarePaginator
    {
        return $this->categoryRepository->fetchAll();
    }

    /**
     * Get All Categories
     *
     * @return Collection
     */
    public function getListActiveCategories(): Collection
    {
        return $this->categoryRepository->fetchActiveListCategories();
    }

    /**
     * Get All Categories with product counts
     *
     * @return Collection
     */
    public function fetchActiveCategoriesWithCountProducts(): Collection
    {
        return $this->categoryRepository->fetchActiveCategoriesWithCountProducts();
    }

    /**
     * Get All Categories
     *
     * @return Collection
     */
    public function getListCategories(): Collection
    {
        return $this->categoryRepository->fetchListCategories();
    }

    /**
     *
     * @param string|null $order
     * 
     * @return Collection
     */
    public function categoriesByOrder(string $order = null): Collection
    {
        return $this->categoryRepository->getCategoriesByOrder($order);
    }

    /**
     *
     * @return Category|null
     */
    public function fetchFirst(): ?ModelCategory
    {
        return $this->categoryRepository->getEnabledCategory();
    }

    /**
     *
     * @param array $data
     *
     * @return ModelCategory
     */
    public function create(array $data): ModelCategory
    {
        $forInsert = $this->matchInputModelValues($data);

        if (!$category = $this->categoryRepository->create($forInsert)) {
            throw new RuntimeException('Category has not been added.');
        }

        return $category;
    }

    /**
     *
     * @param ModelCategory $category
     * @param array $data
     *
     * @return ModelCategory $category
     */
    public function update(ModelCategory $category, array $data): ModelCategory
    {
        $forUpdate = $this->matchInputModelValues($data);

        if (!$this->categoryRepository->update($category, $forUpdate)) {
            throw new RuntimeException('Category has not been updated.');
        }

        return $category;
    }

    /**
     *
     * @param ModelCategory $category
     *
     * @return bool|null
     */
    public function delete(ModelCategory $category): ?bool
    {
        return $this->categoryRepository->delete($category);
    }

    /**
     *
     * @param string|null $slug
     * 
     * @return ModelCategory|null
     */
    public function fetchBySlug(?string $slug): ?ModelCategory
    {
        return $this->categoryRepository->findBySlug($slug);
    }

    /**
     *
     * @param  array $data
     *
     * @return array
     */
    private function matchInputModelValues(array $data): array
    {
        return [
            'name' => $data['name'],
            'description' => $data['description'],
            'is_enabled' => isset($data['is_enabled']) ? true : false,
        ];
    }
}

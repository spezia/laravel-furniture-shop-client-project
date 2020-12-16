<?php

namespace App\Services;

use App\Category;
use App\Product as ModelProduct;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repository\ProductRepository;
use Illuminate\Database\Eloquent\Collection;
use RuntimeException;

/**
 * Product specific functionality
 */
class Product
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Get All Products (admin section)
     *
     * @return LengthAwarePaginator
     */
    public function getAll(): LengthAwarePaginator
    {
        return $this->productRepository->fetchAll();
    }

    /**
     * Get All Enabled Products (admin section, dropdown)
     *
     * @return Collection
     */
    public function getAllEnabled(): Collection
    {
        return $this->productRepository->getAllEnabled();
    }

    /**
     *
     * @param integer $catId
     * 
     * @return Collection
     */
    public function getAllEnabledByCategoryId(int $catId): Collection
    {
        return $this->productRepository->getAllEnabledByCategoryId($catId);
    }

    /**
     * Get All Enabled Products with active discounts (front)
     * for current date
     *
     * @return Collection
     */
    public function getWithDiscounts(): Collection
    {
        return $this->productRepository->getWithDiscounts(now());
    }

    /**
     * Fetch products by Category
     *
     * @param Category $category
     * 
     * @return LengthAwarePaginator
     */
    public function getWithDiscountsByCategory(Category $category): LengthAwarePaginator
    {
        return $this->productRepository->getWithDiscountsByCategory(now(), $category);
    }

    /**
     * Fetch 6 latest products
     *
     * @return Collection
     */
    public function getLatestProducts(): Collection
    {
        return $this->productRepository->getLatestProducts();
    }

    /**
     *
     * @param int $id
     * 
     * @return ModelProduct|null
     */
    public function fetchById(int $id): ?ModelProduct
    {
        return $this->productRepository->getById($id);
    }

    /**
     *
     * @param string|null $slug
     * 
     * @return ModelProduct|null
     */
    public function fetchBySlug(?string $slug): ?ModelProduct
    {
        return $this->productRepository->findBySlug($slug);
    }

    /**
     *
     * @param array $data
     *
     * @return ModelProduct
     */
    public function create(array $data): ModelProduct
    {
        $forInsert = $this->matchInputModelValues($data);

        if (!$product = $this->productRepository->create($forInsert)) {
            throw new RuntimeException('Product has not been added.');
        }

        $product->addAllMediaFromRequest()
            ->each(function ($fileAdder) {
                $fileAdder->toMediaCollection(\config('custom.media.product'));
            });

        return $product;
    }

    /**
     *
     * @param ModelProduct $product
     * @param array $data
     *
     * @return ModelProduct $product
     */
    public function update(ModelProduct $product, array $data): ModelProduct
    {
        $forUpdate = $this->matchInputModelValues($data);

        if (!$this->productRepository->update($product, $forUpdate)) {
            throw new RuntimeException('Product has not been updated.');
        }

        $product->addAllMediaFromRequest()
            ->each(function ($fileAdder) {
                $fileAdder->toMediaCollection(\config('custom.media.product'));
            });


        return $product;
    }

    /**
     *
     * @param ModelProduct $product
     *
     * @return bool|null
     */
    public function delete(ModelProduct $product): ?bool
    {
        return $this->productRepository->delete($product);
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
            'code' => $data['code'],
            'properties' => $this->makeJsonOfProperties($data['properties']),
            'price' => floatval($data['price']),
            'category_id' => $data['category'],
            'is_enabled' => isset($data['is_enabled']) ? true : false,
        ];
    }

    /**
     * Sanitize textarea field (skip empty values, trim values,...)
     * 
     * @param string $data
     * 
     * @return array|null
     */
    private function makeJsonOfProperties(array $data): ?array
    {
        $response = [];
        if (!$data) {
            return null;
        }

        foreach ($data as $local => $properties) {
            $arrayProperties = explode(',', $properties);
            if ($arrayProperties) {
                $values = [];
                foreach ($arrayProperties as $property) {
                    $property = trim($property);

                    if ($property) {
                        $array = explode(':', $property);
                        $values[] = "{$array[0]}:{$array[1]}";
                    }
                }
                $response[$local] = implode(',', $values);
            }
        }

        return $response;
    }
}

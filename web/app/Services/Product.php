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
     * @param integer $productId
     * 
     * @return Collection
     */
    public function getSimilarProduct(int $catId, int $productId): Collection
    {
        return $this->productRepository->getSimilarProduct($catId, $productId);
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
     * @param array $order
     * 
     * @return LengthAwarePaginator
     */
    public function getWithDiscountsByCategory(Category $category, array $order = null): LengthAwarePaginator
    {
        $products = $this->productRepository->getWithDiscountsByCategory(now(), $category);

        return $this->sortProductsInPagination($products, $order);
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
                        if (!isset($array[0]) || !isset($array[1])) {
                            throw new RuntimeException('Property format (Properties field) is not good. It should be `property:value` separate by comma.');
                        }
                        $values[] = "{$array[0]}:{$array[1]}";
                    }
                }
                $response[$local] = implode(',', $values);
            }
        }

        return $response;
    }

    /**
     * Sort collection in pagination
     *
     * @param Collection $productCollection
     * @param array $order
     * 
     * @return LengthAwarePaginator
     */
    public function sortProductsInPagination(Collection $productCollection, array $order = null): LengthAwarePaginator
    {
        // default without order
        $collection = $productCollection;

        if ($order && $order['order'] == 'asc') {
            $collection = $productCollection->sortBy($order['column']);
        } elseif ($order && $order['order'] == 'desc') {
            $collection = $productCollection->sortByDesc($order['column']);
        }
        unset($productCollection);

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = \config('custom.pages.show_per_page');
        $offset = ($currentPage * $perPage) - $perPage;
        // Slice the collection to get the products to display in current page
        $currentPageProducts = $collection->slice($offset, $perPage)->all();

        // Create our paginator and pass it to the view
        return new LengthAwarePaginator($currentPageProducts, $collection->count(), $perPage);
    }
}

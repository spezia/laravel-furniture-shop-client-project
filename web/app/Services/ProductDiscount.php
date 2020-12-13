<?php

namespace App\Services;

use App\ProductDiscount as ModelProductDiscount;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repository\ProductDiscountRepository;
use App\Repository\ProductRepository;
use Carbon\Carbon;
use RuntimeException;

/**
 * ProductDiscount specific functionality
 */
class ProductDiscount
{
    /**
     * @var ProductDiscountRepository
     */
    private $productDiscountRepository;

    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * @param ProductDiscountRepository $productDiscountRepository
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductDiscountRepository $productDiscountRepository, ProductRepository $productRepository)
    {
        $this->productDiscountRepository = $productDiscountRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * Get All ProductDiscounts
     *
     * @return LengthAwarePaginator
     */
    public function getAll(): LengthAwarePaginator
    {
        return $this->productDiscountRepository->fetchAll();
    }

    /**
     *
     * @param array $data
     *
     * @return ModelProductDiscount
     */
    public function create(array $data): ModelProductDiscount
    {
        $forInsert = $this->matchInputModelValues($data);

        if (!$productDiscount = $this->productDiscountRepository->create($forInsert)) {
            throw new RuntimeException('ProductDiscount has not been added.');
        }

        return $productDiscount;
    }

    /**
     *
     * @param ModelProductDiscount $productDiscount
     * @param array $data
     *
     * @return ModelProductDiscount $productDiscount
     */
    public function update(ModelProductDiscount $productDiscount, array $data): ModelProductDiscount
    {
        $forUpdate = $this->matchInputModelValues($data);

        if (!$this->productDiscountRepository->update($productDiscount, $forUpdate)) {
            throw new RuntimeException('ProductDiscount has not been updated.');
        }

        return $productDiscount;
    }

    /**
     *
     * @param ModelProductDiscount $productDiscount
     *
     * @return bool|null
     */
    public function delete(ModelProductDiscount $productDiscount): ?bool
    {
        return $this->productDiscountRepository->delete($productDiscount);
    }

    /**
     * Calculate discount in %
     *
     * @param integer $productid
     * @param string $newPrice
     * 
     * @return string
     */
    public function calculateDiscount(int $productid, string $newPrice): string
    {
        if (!$product = $this->productRepository->getById($productid)) {
            throw new RuntimeException('Not found product');
        }

        return round(($newPrice / $product->price * 100) - 100); // in %
    }

    /**
     *
     * @param  array $data
     *
     * @return array
     */
    private function matchInputModelValues(array $data): array
    {
        $dateFrom = new Carbon($data['from']);
        $dateTo = new Carbon($data['to']);
        $newPrice = floatval($data['new_price']);

        return [
            'product_id' => $data['product_id'],
            'new_price' => $newPrice,
            'discount' => $this->calculateDiscount($data['product_id'], $newPrice) . ' %', // 25 %
            'from' => $dateFrom->startOfDay(), // ex. 2020-11-23 00:00:00.0 UTC (+00:00)
            'to' => $dateTo->endOfDay(), // ex. 2020-11-29 23:59:59.999999 UTC (+00:00)
        ];
    }
}

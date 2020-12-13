<?php

namespace App\Repository;

use App\ProductDiscount;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class ProductDiscountRepository
 */
class ProductDiscountRepository
{
    /**
     * Return all productDiscounts
     *
     * @return LengthAwarePaginator
     */
    public function fetchAll(): LengthAwarePaginator
    {
        return ProductDiscount::has('product')
            ->orderBy('id', 'desc')
            ->paginate(\config('custom.pages.page'));
    }

    /**
     * Get ProductDiscount by id.
     * 
     * @param int $productDiscountId
     * 
     * @return ProductDiscount|null
     */
    public function getById(int $productDiscountId): ?ProductDiscount
    {
        return ProductDiscount::has('product')->where('id', $productDiscountId)->first();
    }

    /**
     * Create ProductDiscount
     *
     * @param array $data
     * @return ProductDiscount
     */
    public function create(array $data): ProductDiscount
    {
        return ProductDiscount::create($data);
    }

    /**
     * Update ProductDiscount
     *
     * @param ProductDiscount $productDiscount
     * @param array $fields
     *
     * @return ProductDiscount
     */
    public function update(ProductDiscount $productDiscount, array $fields): ProductDiscount
    {
        $productDiscount->fill($fields);
        $productDiscount->save();

        return $productDiscount;
    }

    /**
     * Remove ProductDiscount
     *
     * @param  ProductDiscount $productDiscount
     *
     * @return bool|null
     */
    public function delete(ProductDiscount $productDiscount): ?bool
    {
        return $productDiscount->delete();
    }
}

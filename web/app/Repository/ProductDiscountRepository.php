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
     * @param array $searchData
     *
     * @return LengthAwarePaginator
     */
    public function fetchAll(array $searchData = []): LengthAwarePaginator
    {
        $qb = ProductDiscount::has('product')
            ->with('product')
            ->orderBy('id', 'desc');

        if (isset($searchData['name']) && $searchData['name']) {
            $qb->whereHas('product', function ($q) use ($searchData) {
                $q->where('name', 'like', '%' . $searchData['name'] . '%');
            });
        }

        if (isset($searchData['discount']) && $searchData['discount']) {
            $qb->where('discount', 'like', '%' . $searchData['discount'] . '%');
        }

        if (isset($searchData['status'])) {
            if ($searchData['status'] == 'active') {
                $qb->where('from', '<', now())
                    ->where('to', '>', now());
            } elseif ($searchData['status'] == 'inactive') {
                $qb->where('from', '>', now())
                    ->orWhere('to', '<', now());
            }
        }

        return $qb->paginate(\config('custom.pages.show_per_page'));
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

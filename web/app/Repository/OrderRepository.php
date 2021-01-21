<?php

namespace App\Repository;

use App\Order;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Class OrderRepository
 */
class OrderRepository
{
    /**
     * Store Order
     *
     * @param array $order
     * @param array $orderItems
     * 
     * @return Order
     */
    public function save(array $order, array $orderItems): Order
    {
        return DB::transaction(function () use ($order, $orderItems) {
            $model = new Order();
            $model->fill($order);
            $model->save();

            $model->orderItems()->createMany($orderItems);

            return $model;
        });
    }

    /**
     * Return all products (admin)
     * 
     * @param array $searchData
     *
     * @return LengthAwarePaginator
     */
    public function fetchAll(array $searchData = []): LengthAwarePaginator
    {
        $qb = Order::with('orderItems')
            ->orderBy('created_at', 'desc');

        if (isset($searchData['name']) && $searchData['name']) {
            $qb->whereHas('orderItems', function ($query) use ($searchData) {
                $query->where('name', 'like', '%' . $searchData['name'] . '%');
            });
        }

        if (isset($searchData['email']) && $searchData['email']) {
            $qb->where('email', 'like', $searchData['email'] . '%');
        }

        if (isset($searchData['firstname']) && $searchData['firstname']) {
            $qb->where('firstname', 'like', $searchData['firstname'] . '%');
        }

        if (isset($searchData['lastname']) && $searchData['lastname']) {
            $qb->where('lastname', 'like', $searchData['lastname'] . '%');
        }

        if (isset($searchData['type'])) {
            $qb->where('transaction_type', $searchData['type']);
        }

        return $qb->paginate(\config('custom.pages.show_per_page'));
    }

    /**
     * Get Order by id. (admin)
     * 
     * @param int $orderId
     * 
     * @return Order|null
     */
    public function getById(int $orderId): ?Order
    {
        return Order::where('id', $orderId)->first();
    }

    /**
     * Remove Order
     *
     * @param  Order $order
     *
     * @return bool|null
     */
    public function delete(Order $order): ?bool
    {
        foreach ($order->orderItems as $item) {
            $item->delete();
        }

        return $order->delete();
    }
}

<?php

namespace App\Services;

use App\Order as ModelOrder;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repository\OrderRepository;

/**
 * Order specific functionality
 */
class Order
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;

    /**
     * @param OrderRepository $orderRepository
     */
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Get All Orders (admin section)
     * 
     * @param array $searchData
     *
     * @return LengthAwarePaginator
     */
    public function getAll(array $searchData = []): LengthAwarePaginator
    {
        return $this->orderRepository->fetchAll($searchData);
    }

    /**
     *
     * @param int $id
     * 
     * @return ModelOrder|null
     */
    public function fetchById(int $id): ?ModelOrder
    {
        return $this->orderRepository->getById($id);
    }

    /**
     *
     * @param ModelOrder $order
     *
     * @return bool|null
     */
    public function delete(ModelOrder $order): ?bool
    {
        return $this->orderRepository->delete($order);
    }
}

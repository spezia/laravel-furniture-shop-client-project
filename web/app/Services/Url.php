<?php

namespace App\Services;

/**
 * Url specific functionality
 */
class Url
{
    const PRICEUP = 'price-up';
    const PRICEDOWN = 'price-down';
    const NAMEUP = 'name-up';
    const NAMEDOWN = 'name-down';

    /**
     * @return array
     */
    public function fetchSortOptions(): array
    {
        return [
            self::PRICEUP => trans('custom.priceup'),
            self::PRICEDOWN => trans('custom.pricedown'),
            self::NAMEUP => trans('custom.nameup'),
            self::NAMEDOWN => trans('custom.namedown'),
        ];
    }

    /**
     *
     * @param string $orderBy
     * 
     * @return array|null
     */
    public function getOrderBy(string $orderBy): ?array
    {
        $order = null;

        switch ($orderBy) {
            case self::PRICEUP:
                $order = [
                    'column' => 'price',
                    'order' => 'asc',
                ];
                break;
            case self::PRICEDOWN:
                $order = [
                    'column' => 'price',
                    'order' => 'desc',
                ];
                break;
            case self::NAMEUP:
                $order = [
                    'column' => 'name',
                    'order' => 'asc',
                ];
                break;
            case self::NAMEDOWN:
                $order = [
                    'column' => 'name',
                    'order' => 'desc',
                ];
                break;
        }

        return $order;
    }
}

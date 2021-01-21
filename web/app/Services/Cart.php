<?php

namespace App\Services;

use App\Order;
use App\Product;
use App\Repository\OrderRepository;
use RuntimeException;

/**
 * Cart specific functionality
 */
class Cart
{
    /**
     * @var OrderRepository
     */
    private $repository;

    /**
     * @param OrderRepository $repository
     */
    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Add item to cart
     *
     * @param Product $product
     * @param integer $quantity
     * 
     * @return boolean
     */
    public function addToCart(Product $product, int $quantity): bool
    {
        $cart = session('cart', null);

        // if cart is empty or product is not in the cart
        if (!isset($cart[$product->id])) {
            $cart[$product->id] = [
                'name' => $product->name,
                'quantity' => $quantity,
                'price' => $product->new_price,
                'properties' => $product->properties,
                'product' => $product
            ];
            session()->put('cart', $cart);

            return true;
        }

        // if cart not empty then check if this product exist then increment quantity
        $cart[$product->id]['quantity'] = $cart[$product->id]['quantity'] + $quantity;
        session()->put('cart', $cart);

        return true;
    }

    /**
     * Store order with products
     *
     * @param array $data
     * 
     * @return Order
     */
    public function storeOrder(array $data): Order
    {
        $total = 0;
        if (!session()->has('cart')) {
            throw new RuntimeException('No items in shopping cart');
        }

        foreach (session('cart') as $id => $product) {

            $productTotal = $product['price'] * $data['quantity'][$id];
            $total = $total + $productTotal;
            $orderItems[] = [
                'product_id' =>  $id,
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => $data['quantity'][$id],
                'properties' => $this->getProductPropertiesData($product['properties']),
                'total' => $productTotal,
            ];
        }

        if ((int) $data['total-price'] !== (int) $total) {
            throw new RuntimeException('Something is wrong');
        }

        $order = [
            'firstname' => $data['first-name'],
            'lastname' => $data['last-name'],
            'email' => $data['email'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'transaction_type' => $data['paying-method'],
            'transaction_data' => json_encode($this->getTransactionData($data)),
            'order_total' => $total,
        ];

        return $this->repository->save($order, $orderItems);
    }

    /**
     * @param array $data
     *
     * @return array
     */
    private function getTransactionData(array $data): array
    {
        if ($data['paying-method'] == Order::TRANSACTION_PAYPAL) {
            return [
                'username' => $data['paypal-username'],
                'email' => $data['paypal-email'],
            ];
        } elseif ($data['paying-method'] == Order::TRANSACTION_BANK) {
            return [
                'firstname' => $data['card-first-name'],
                'lastname' => $data['card-last-name'],
                // I think this is not relevant to store in db
                // 'number' => $data['card-number'],
                // 'expired' => $data['card-date'],
                // 'code' => $data['card-security-code'],
            ];
        }

        throw new RuntimeException('Invalid transaction type');
    }


    /**
     * Get array in this format
     * array:3 [
     *      0 => "height: 180"
     *      1 => "weight: 120"
     *      2 => "length: 50"
     * ]
     *
     * @param string $properties
     * @return string
     */
    public function getProductPropertiesData(string $properties): string
    {
        return json_encode(explode(',', $properties));
    }
}

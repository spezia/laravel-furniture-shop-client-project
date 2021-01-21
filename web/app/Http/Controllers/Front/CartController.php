<?php

namespace App\Http\Controllers\Front;

use App\Events\ProductOrder;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Order;
use App\Services\Cart;
use App\Services\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{

    /**
     * Show Shopping Cart
     * 
     * @return Response
     */
    public function home()
    {
        return view('front.cart.show', [
            'total' => 0, // default
            'paypal' => Order::TRANSACTION_PAYPAL,
            'bank' => Order::TRANSACTION_BANK
        ]);
    }

    /**
     * Add to shopping cart
     *
     * @param Request $request
     * @param integer $id
     * @param Cart $service
     * @param Product $productService
     * 
     * @return Response
     */
    public function add(Request $request, int $id, Cart $service, Product $productService)
    {
        if (!$product = $productService->fetchById($id)) {
            abort(404);
        }

        // use 1 if we send from list, on show page we can add quantity
        $service->addToCart($product, $request->get('quantity', 1));

        return response()->json([
            'status' => 1,
            'totalItems' => count(session('cart')),
            'msg' => trans('custom.add-to-cart'),
        ], 200);
    }

    /**
     * Take order, pay and store 
     *
     * @param OrderRequest $request
     * @param Cart $service
     * 
     * @return Response
     */
    public function order(OrderRequest $request, Cart $service)
    {
        try {
            // 1. process payment

            // 2. save order to local database
            $order = $service->storeOrder($request->all());

            // 3. make event to send emails (client and admin)
            event(new ProductOrder($order));

            // 4. flush session
            session()->remove('cart');

            return response()->json([
                'status' => 1,
                'order' => [
                    'id' => $order->id,
                    'total' => $order->order_total
                ],
            ], 200);
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return response()->json([
                'status' => 0,
                'msg' => trans('error'),
            ], 400);
        }
    }
}

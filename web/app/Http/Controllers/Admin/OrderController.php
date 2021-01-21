<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order as AppOrder;
use App\Services\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param Order $servise
     *
     * @return Response
     */
    public function index(Request $request, Order $servise)
    {
        return view('admin.orders.home', [
            'data' => $servise->getAll($request->all()),
            'orderTypes' => [1 => AppOrder::TRANSACTION_PAYPAL, 2 => AppOrder::TRANSACTION_BANK]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     *
     * @return Response
     */
    public function show(AppOrder $order)
    {
        return view('admin.orders.view', [
            'order' => $order,
            'collection' => \config('custom.media.order'),
        ]);
    }

    /**
     * Destroy order
     *
     * @param Order $service
     * @param Order $order
     *
     * @return Response|RedirectResponse
     */
    public function destroy(Order $service, AppOrder $order)
    {
        if ($service->delete($order)) {
            return redirect()->route('orders.index')->with('message', 'Order has been removed.');
        }

        return back()->with('error', 'Order has not been removed.');
    }
}

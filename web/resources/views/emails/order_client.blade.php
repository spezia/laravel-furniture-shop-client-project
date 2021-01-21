<html>
<head></head>
<body>
<p>Hello {{ $order->lastname }} {{ $order->firstname }},</p>
<p>
    <p>Your Order from {{ $order->created_at->format('Y/m/d') }}</p>
    <hr/>
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Item price</th>
                <th>Quantity</th>
                <th>Item price total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderItems as $item)
            <tr>
                <th>{{ $item->name }}</th>
                <th>{{ $item->price }}</th>
                <th>{{ $item->quantity }}</th>
                <th>{{ $item->total }}</th>
            </tr>
            @endforeach
            <tr>
                <th>Total:</th>
                <th colspan="43">{{ \config('custom.currency') .' '. $order->order_total }}</th>
            </tr>
        </tbody>
    </table>
</p>
</body>
</html>

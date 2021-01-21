<html>
<head></head>
<body>
<p>Hey Admin,</p>
<p>
    New Order from
    <p>Firstname: {{ $order->firstname }}</p>
    <p>Lastname: {{ $order->lastname }}</p>
    <p>Email: {{ $order->email }}</p>
    <p>Address: {{ $order->address }}</p>
    <p>Phone: {{ $order->phone }}</p>
    <hr/>
    <p>Transaction type: {{ $order->transaction_type }}</p>
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

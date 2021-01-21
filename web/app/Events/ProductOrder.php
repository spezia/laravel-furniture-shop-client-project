<?php

namespace App\Events;

use App\Order;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProductOrder
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The Order
     *
     * @var Order
     */
    public $order;

    /**
     * Create a new event instance.
     *
     * @param  Order  $order
     * 
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }
}

<?php

namespace App\Listeners;

use App\Events\ProductOrder;
use App\Mail\OrderSendAdminMail;
use App\Mail\OrderSendMail;
use App\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use function config;

class OrderSendEmail implements ShouldQueue
{

    /**
     * Handle the event.
     *  Send the verification email to the user
     *
     * @param  EventNewEmailVerification $event
     * 
     * @return void
     */
    public function handle(ProductOrder $event): void
    {
        if ($event->order instanceof Order) {
            Mail::to($event->order->email)->send(new OrderSendMail($event->order));
            Mail::to(config('mail.to_admin.address'))->send(new OrderSendAdminMail($event->order));
        }
    }
}

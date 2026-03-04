<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Mail\OrderConfirmed;
use Illuminate\Support\Facades\Mail;

class SendOrderConfirmation
{
    public function handle(OrderCreated $event): void
    {
        $order = $event->order;

        if ($order->user && $order->user->email) {
            Mail::to($order->user->email)->send(new OrderConfirmed($order));
        }
    }
}

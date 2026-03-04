<?php

namespace App\Listeners;

use App\Events\OrderStatusChanged;
use App\Mail\OrderStatusUpdated;
use Illuminate\Support\Facades\Mail;

class SendOrderStatusUpdate
{
    public function handle(OrderStatusChanged $event): void
    {
        $order = $event->order;

        if ($order->user && $order->user->email) {
            Mail::to($order->user->email)->send(
                new OrderStatusUpdated($order, $event->oldStatus, $event->newStatus)
            );
        }
    }
}

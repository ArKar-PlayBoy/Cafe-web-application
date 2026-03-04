<?php

namespace App\Exceptions;

use Exception;

class OrderNotFoundException extends Exception
{
    public function __construct(int|string|null $orderId = null)
    {
        $message = $orderId
            ? "Order #{$orderId} not found"
            : 'Order not found';

        parent::__construct($message, 0);
    }

    public function render()
    {
        return response()->json([
            'error' => 'Not Found',
            'message' => $this->getMessage(),
        ], 404);
    }
}

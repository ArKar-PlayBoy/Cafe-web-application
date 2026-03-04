<?php

namespace App\Exceptions;

use Exception;

class PaymentFailedException extends Exception
{
    public function __construct(string $message = 'Payment processing failed', ?Exception $previous = null)
    {
        parent::__construct($message, 0, $previous);
    }

    public function render()
    {
        return response()->json([
            'error' => 'Payment Failed',
            'message' => $this->getMessage(),
        ], 402);
    }
}

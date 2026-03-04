<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'menu_item_id' => $this->menu_item_id,
            'menu_item_name' => $this->menuItem?->name,
            'quantity' => (int) $this->quantity,
            'price' => (float) $this->price,
            'subtotal' => (float) ($this->quantity * $this->price),
        ];
    }
}

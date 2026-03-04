<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\OrderNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Get authenticated user's orders
     */
    public function index(Request $request): JsonResponse
    {
        $orders = Order::with('items.menuItem')
            ->where('user_id', $request->user()->id)
            ->latest()
            ->paginate(15);

        return response()->json([
            'success' => true,
            'data' => OrderResource::collection($orders),
            'meta' => [
                'current_page' => $orders->currentPage(),
                'last_page' => $orders->lastPage(),
                'per_page' => $orders->perPage(),
                'total' => $orders->total(),
            ],
        ]);
    }

    /**
     * Get single order details
     */
    public function show(Request $request, int $id): JsonResponse
    {
        $order = Order::with('items.menuItem')
            ->where('user_id', $request->user()->id)
            ->find($id);

        if (! $order) {
            throw new OrderNotFoundException($id);
        }

        return response()->json([
            'success' => true,
            'data' => new OrderResource($order),
        ]);
    }
}

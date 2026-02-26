<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Reservation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'pendingOrders' => Order::where('status', 'pending')->count(),
            'preparingOrders' => Order::where('status', 'preparing')->count(),
            'readyOrders' => Order::where('status', 'ready')->count(),
            'pendingReservations' => Reservation::where('status', 'pending')->count(),
        ];

        return view('staff.dashboard', compact('stats'));
    }
}

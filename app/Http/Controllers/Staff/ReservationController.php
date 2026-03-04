<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with('user', 'table')->latest()->get();
<<<<<<< HEAD
=======

>>>>>>> 5b466fb (more reliable and front-end changes)
        return view('staff.reservations.index', compact('reservations'));
    }

    public function updateStatus(Request $request, Reservation $reservation)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);

        $reservation->update(['status' => $request->status]);
<<<<<<< HEAD
=======

>>>>>>> 5b466fb (more reliable and front-end changes)
        return back()->with('success', 'Reservation status updated successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\CafeTable;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with('table')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();
        
        return view('customer.reservations.index', compact('reservations'));
    }

    public function create()
    {
        $tables = CafeTable::where('status', 'available')
            ->where('capacity', '>=', 1)
            ->get();
        
        return view('customer.reservations.create', compact('tables'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'reservation_date' => 'required|date|after_or_equal:today',
            'reservation_time' => 'required',
            'party_size' => 'required|integer|min:1|max:20',
            'table_id' => 'nullable|exists:cafe_tables,id',
            'notes' => 'nullable|string',
        ]);

        $tableId = null;
        
        if ($request->table_id) {
            $table = CafeTable::where('id', $request->table_id)
                ->where('status', 'available')
                ->where('capacity', '>=', $request->party_size)
                ->first();
            
            if ($table) {
                $tableId = $table->id;
            }
        } else {
            $availableTable = CafeTable::where('status', 'available')
                ->where('capacity', '>=', $request->party_size)
                ->first();
            
            if ($availableTable) {
                $tableId = $availableTable->id;
            }
        }

        Reservation::create([
            'user_id' => auth()->id(),
            'table_id' => $tableId,
            'reservation_date' => $request->reservation_date,
            'reservation_time' => $request->reservation_time,
            'party_size' => $request->party_size,
            'status' => 'pending',
            'notes' => $request->notes,
        ]);

        return redirect()->route('reservations.index')->with('success', 'Reservation made successfully!');
    }
}

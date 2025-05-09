<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TableReservation;


class adminBookingController extends Controller
{
    

    public function showBookingDetails($id)
    {
        $booking = TableReservation::findOrFail($id);
        return view('admin.bookingDetails', compact('booking'));
    }
    

       public function storeReservation(Request $request)
    {
        $validated = $request->validate([
        'customer_name' => 'required|string|max:255',
        'customer_phone' => 'required|string|max:20',
        'number_of_people' => 'required|numeric|min:1',
        'reservation_date' => 'required|date|after_or_equal:today',
        'reservation_time' => 'required',

    ]);

    TableReservation::create([
        ...$validated,
        'status' => 'pending', 
    ]);

    return redirect()->back()->with('success', 'تم حجز الطاولة بنجاح!');
    }


       public function ManageBookFunction()
       {
           $bookings = TableReservation::all(); // استرجاع كل الحجوزات
           return view('admin.ManageBook', compact('bookings'));
       }

}

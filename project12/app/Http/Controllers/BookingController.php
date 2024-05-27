<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Item;

class BookingController extends Controller
{
    public function getUnavailableDates(Item $item)
    {
        $bookings = Booking::where('item_id', $item->id)->get(['start_date', 'end_date']);
        $dates = [];

        foreach ($bookings as $booking) {
            $period = new \DatePeriod(
                new \DateTime($booking->start_date),
                new \DateInterval('P1D'),
                (new \DateTime($booking->end_date))->modify('+1 day')
            );

            foreach ($period as $date) {
                $dates[] = $date->format('Y-m-d');
            }
        }

        return response()->json(['dates' => $dates]);
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'item_id' => 'required|exists:items,id',
        'start_date' => 'required|date_format:d/m/Y',
        'end_date' => 'required|date_format:d/m/Y',
    ]);

    $startDate = \Carbon\Carbon::createFromFormat('d/m/Y', $validated['start_date']);
    $endDate = \Carbon\Carbon::createFromFormat('d/m/Y', $validated['end_date']);

    Booking::create([
        'user_id' => auth()->id(),
        'item_id' => $validated['item_id'],
        'start_date' => $startDate,
        'end_date' => $endDate,
    ]);

    return redirect()->back()->with('success', 'Item booked successfully.');
}

}


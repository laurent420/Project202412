<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\CartItem;
use App\Models\Item;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'item_id' => 'required|exists:items,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Check for overlapping bookings
        $existingBooking = Booking::where('item_id', $request->item_id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                    ->orWhereBetween('end_date', [$request->start_date, $request->end_date])
                    ->orWhere(function ($query) use ($request) {
                        $query->where('start_date', '<=', $request->start_date)
                            ->where('end_date', '>=', $request->end_date);
                    });
            })->exists();

        if ($existingBooking) {
            return response()->json(['error' => 'These dates are already booked.'], 422);
        }

        // Fetch the item
        $item = Item::find($request->item_id);

        if ($item->quantity < 1) {
            return response()->json(['error' => 'This item is out of stock.'], 422);
        }

        // Create the booking
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'item_id' => $request->item_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        // Decrement the item quantity
        $item->decrement('quantity');

        // Remove the item from the cart
        CartItem::where('user_id', Auth::id())
            ->where('item_id', $request->item_id)
            ->delete();

        return response()->json(['message' => 'Item booked successfully.'], 200);
    }
}

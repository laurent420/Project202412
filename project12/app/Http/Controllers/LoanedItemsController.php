<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Item;
use App\Models\Lending; // Import the Lending model

class LoanedItemsController extends Controller
{
    public function index(Request $request)
    {
        // Check if there's a search query
        $search = $request->input('search');

        if ($search) {
            // Search loaned items by item name or brand
            $loanedItems = Lending::whereHas('itemGroup', function ($query) use ($search) {
                $query->where('name', 'LIKE', $search . '%');
            })->with('itemGroup')->get();
        } else {
            // Fetch all loaned items if there's no search query
            $loanedItems = Lending::with('itemGroup')->get();
        }

        // Pass the loaned items to the view for both admin and non-admin users
        return view('loaneditems', compact('loanedItems'));
    }


    

    

    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'brand' => 'required',
            'name' => 'required',
            'picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'quantity' => 'required|integer|min:1',
        ]);

        // Handle picture upload
        if ($request->hasFile('picture')) {
            $imageName = time() . '.' . $request->picture->extension();
            $request->picture->move(public_path('images'), $imageName);
            $validated['picture'] = 'images/' . $imageName;
        }

        // Create the items based on quantity
        for ($i = 0; $i < $request->quantity; $i++) {
            Item::create($validated);
        }

        // Redirect back with success message
        return redirect()->back()->with('success', 'Items added successfully.');
    }

    
}

   


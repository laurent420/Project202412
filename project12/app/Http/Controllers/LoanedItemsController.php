<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Item;


class LoanedItemsController extends Controller
{
    
    public function index(Request $request)
    {
        // Check if there's a search query
        $search = $request->input('search');
    
        if ($search) {
            // Search loaned items by name or first letter
            $loanedItems = Booking::whereHas('item', function ($query) use ($search) {
                $query->where('name', 'LIKE', $search . '%');
            })->with('item')->get();
        } else {
            // Fetch all loaned items if there's no search query
            $loanedItems = Booking::with('item')->get();
        }
    
        // Pass the loaned items to the view
        return view('loaneditems', compact('loanedItems'));
    }
    

    public function store(Request $request)
{
    // Validate the request data
    $validated = $request->validate([
        'name' => 'required',
        'picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming picture is an image file
        'quantity' => 'required|integer|min:0',

    ]);

    // Handle picture upload
   // Handle picture upload
   if ($request->hasFile('picture')) {
    // Generate a unique name for the image
    $imageName = time() . '.' . $request->picture->extension();

    // Move the image to the 'public/images' directory
    $request->picture->move(public_path('images'), $imageName);

    // Store the image path in the validated data array
    $validated['picture'] = 'images/' . $imageName;
}

    // Create the item
    Item::create($validated);

    // Redirect back with success message
    return redirect()->back()->with('success', 'Item added successfully.');
}

    
}

   


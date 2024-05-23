<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Booking;

class ItemController extends Controller
{
    // Method to display items
    public function index()
    {
        // Fetch all items from the database
        $items = Item::all();

        // Pass the items to the view
        return view('dashboard', compact('items'));
    }

    public function store(Request $request)
{
    // Validate the request data
    $validated = $request->validate([
        'name' => 'required',
        'picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming picture is an image file
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

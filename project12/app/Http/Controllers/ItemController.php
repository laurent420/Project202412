<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

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
    if ($request->hasFile('picture')) {
        // Store the image in the 'item_pictures' directory within 'storage/app'
        $picturePath = $request->file('picture')->store('item_pictures');
        $validated['picture'] = $picturePath;
    }

    // Create the item
    Item::create($validated);

    // Redirect back with success message
    return redirect()->back()->with('success', 'Item added successfully.');
}

    
}

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
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'picture' => 'image|mimes:jpeg,png,jpg,gif|max:128', // Assuming picture is an image file
        ]);
    
        // Create the item without the serial number first
        $item = new Item();
        $item->name = $request->name;
        $item->brand = $request->brand;
        $item->save();
    
        // Generate the serial number based on the item ID
        $serialnumber = strtoupper(substr($item->brand, 0, 2) . substr($item->name, 0, 2) . $item->id);
    
        // Update the item with the generated serial number
        $item->serialnumber = $serialnumber;
    
        // Handle picture upload
        if ($request->hasFile('picture')) {
            // Store the image in the 'item_pictures' directory within 'storage/app'
            $picturePath = $request->file('picture')->store('item_pictures');
            $item->picture = $picturePath;
        }
    
        $item->save(); // Save the item with the serial number and picture path
    
        // Redirect back with success message
        return redirect()->route('dashboard')->with('success', 'Item added successfully.');
    }
    

    
}

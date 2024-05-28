<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\ItemGroup;

class ItemController extends Controller
{
    // Method to display items
    public function index(Request $request)
    {
        // Check if there's a search query
        $search = $request->input('search');

        if ($search) {
            // Search items by name or first letter
            $items = Item::where('name', 'LIKE', $search . '%')->get();
        } else {
            // Fetch all items if there's no search query
            $items = Item::all();
        }

        // Pass the items to the view
        return view('dashboard', compact('items'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming picture is an image file
        ]);

        // Handle picture upload
        if ($request->hasFile('picture')) {
            // Generate a unique name for the image
            $imageName = time() . '.' . $request->picture->extension();

            // Move the image to the 'public/images' directory
            $request->picture->move(public_path('images'), $imageName);

            // Store the image path in the validated data array
            $validated['picture'] = 'images/' . $imageName;
        }

        // Create or find the item group
        $itemGroup = ItemGroup::firstOrCreate(
            [
                'name' => $validated['name'],
                'brand' => $validated['brand']
            ],
            [
                'quantity' => 0 // Corrected spelling
            ]
        );

        // Create the new item and set the item_group_id
        $item = new Item($validated);
        $item->item_group_id = $itemGroup->id; // Assign the item group ID
        $item->status = false;
        $item->save(); // Save to get the item ID

        // Generate the serial number based on the item ID
        $serialnumber = strtoupper(substr($item->brand, 0, 2) . substr($item->name, 0, 2) . $item->id);
        $item->serialnumber = $serialnumber;

        // Save the changes to the item with the generated serial number
        $item->save();

        // Increment the item group's quantity
        $itemGroup->increment('quantity'); // Corrected spelling

        return response()->json([
            'message' => 'Item created successfully and grouped',
            'item' => $item,
            'item_group' => $itemGroup
        ]);
    }



}
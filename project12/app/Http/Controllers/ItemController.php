<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required',
            'picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming picture is an image file
        ]);

        // Handle picture upload
        if ($request->hasFile('picture')) {
            $picturePath = $request->file('picture')->store('item_pictures');
            $validated['picture'] = $picturePath;
        }

        // Create the item
        Item::create($validated);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Item added successfully.');
    }
}

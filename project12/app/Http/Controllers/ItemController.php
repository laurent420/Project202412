<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Booking;

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
              'quantity' => 'required|integer|min:0',
          ]);
          
          // Create the item without the serial number first
          $item = new Item();
          $item->name = $request->name;
          $item->brand = $request->brand;
          $item->quantity = $request->quantity; // Set the quantity
          $item->save();
          
          // Generate the serial number based on the item ID
          $serialnumber = strtoupper(substr($item->brand, 0, 2) . substr($item->name, 0, 2) . $item->id);
      
          // Update the item with the generated serial number
          $item->serialnumber = $serialnumber;
      
          // Handle picture upload
          if ($request->hasFile('picture')) {
              // Generate a unique name for the image
              $imageName = time() . '.' . $request->picture->extension();
      
              // Move the image to the 'public/images' directory
              $request->picture->move(public_path('images'), $imageName);
      
              // Store the image path in the validated data array
              $validated['picture'] = 'images/' . $imageName;
          }
      
          // Save the changes to the item
          $item->update($validated);
      
          // Redirect back with success message
          return redirect()->back()->with('success', 'Item added successfully.');
      }
      
}

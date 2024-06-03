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
            $item_groups = ItemGroup::where('name', 'LIKE', $search . '%')->get();
            $item_groups = ItemGroup::where('brand', 'LIKE', $search . '%')->get();
        } else {
            // Fetch all items if there's no search query
            $items = Item::all();
            $item_groups = ItemGroup::all();
        }

        // Pass the items to the view
        return view('dashboard', compact('item_groups'));
    }
    public function remove(Request $request)
    {
        $item = Item::find($request->id);
        
        if (!$item) {
            return redirect()->back()->with('error', 'Item not found!');
        }
        
        $itemGroup = $item->itemGroup;
        $itemGroupQuantity = $itemGroup->quantity; 
    
        if ($item->status === 1) {
            $item->delete();
            
            // Retrieve the current quantity of the ItemGroup
            $newItemGroupQuantity = Item::where('item_group_id', $itemGroup->id)->count();
            
            // Check if the new quantity is zero, then delete the ItemGroup
            if ($newItemGroupQuantity === 0) {
                $itemGroup->delete();
            }
            
            return redirect()->back()->with('success', 'Item removed successfully!');
        } else {
            return redirect()->back()->with('error', 'Item is currently in use!');
        }
    }
    
    
    public function store(Request $request)
    {
        try {
            // Validate the request data
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'brand' => 'required|string|max:255',
                'picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                // 'item_group_id' => 'required|integer|exists:item_groups,id',
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
                    'quantity' => 0
                ]
            );

            // Create the item
            $item = new Item($validated);
            $item->item_group_id = $itemGroup->id;
            $item->status = false;

            // Save the item to get the ID
            $item->save();

            // Generate the serial number based on the item ID
            $serialnumber = strtoupper(substr($item->brand, 0, 2) . substr($item->name, 0, 2) . $item->id);
            $item->serialnumber = $serialnumber;

            // Update the item with the serial number
            $item->save();

            // Increment the item group's quantity
            $itemGroup->increment('quantity');

            // Redirect back to the same page
            return redirect()->back();
        } catch (\Exception $e) {
            // Return the error message in case of an exception
            return response()->json([
                'message' => 'An error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function loandedItemsAdmin(Request $request)
    {
        // Check if there's a search query
        $search = $request->input('search');

        if ($search) {
            // Search items by name or brand
            $items = Item::where('name', 'LIKE', $search . '%')
                ->orWhere('brand', 'LIKE', $search . '%')
                ->get();
        } else {
            // Fetch all items if there's no search query
            $items = Item::all();
        }


        // Pass the items to the view
        return view('LoanedItems', compact('items'));
    }

}



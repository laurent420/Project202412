<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function add(Request $request)
    {
        $userId = auth()->id(); // Get the current user's ID
        $itemId = $request->input('item_id'); // Get the item ID from the request

        // Check if the item is already favorited by the user
        if (Favorite::where('user_id', $userId)->where('item_id', $itemId)->exists()) {
            return response()->json(['message' => 'Item already favorited.'], 422);
        }

        // Create a new favorite record
        Favorite::create([
            'user_id' => $userId,
            'item_id' => $itemId,
        ]);

        return response()->json(['message' => 'Item added to favorites.']);
    }

    public function index()
    {
        $favorites = auth()->user()->favorites; // Assuming you have a relationship set up correctly
        return view('favourites', compact('favorites'));
    }

    public function destroy($id)
    {
        $userId = auth()->id(); // Get the current user's ID

        // Find the favorite record
        $favorite = Favorite::where('user_id', $userId)->where('item_id', $id)->first();

        if ($favorite) {
            // If the favorite record exists, delete it
            $favorite->delete();
            return response()->json(['message' => 'Item removed from favorites.']);
        } else {
            // If the favorite record does not exist, return an error message
            return response()->json(['message' => 'Item not found in favorites.'], 404);
        }
    }
    
    

}


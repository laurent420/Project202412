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
    
    
    public function remove(Favorite $favorite)
    {
        $favorite->delete();

        return response()->json(['message' => 'Item removed from favorites successfully!']);
    }
}


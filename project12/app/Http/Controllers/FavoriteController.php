<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Log; // Import Log facade

class FavoriteController extends Controller
{
    public function add(Request $request)
    {
        try {
            $userId = auth()->id(); // Get the current user's ID
            $itemGroupId = $request->input('item_group_id'); // Get the item group ID from the request

            Log::info('User ID: ' . $userId); // Log the user ID
            Log::info('Item Group ID: ' . $itemGroupId); // Log the item group ID

            // Check if the item is already favorited by the user
            if (Favorite::where('user_id', $userId)->where('item_group_id', $itemGroupId)->exists()) {
                Log::info('Item already favorited.'); // Log the duplicate favorite case
                return response()->json(['message' => 'Item already favorited.'], 422);
            }

            // Create a new favorite record
            Favorite::create([
                'user_id' => $userId,
                'item_group_id' => $itemGroupId,
            ]);

            Log::info('Item added to favorites.'); // Log the successful addition
            return response()->json(['message' => 'Item added to favorites.']);
        } catch (\Exception $e) {
            Log::error('Error adding item to favorites: ' . $e->getMessage()); // Log any exception
            return response()->json(['message' => 'An error occurred while adding the item to favorites.'], 500);
        }
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
        $favorite = Favorite::where('user_id', $userId)->where('item_group_id', $id)->first();

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



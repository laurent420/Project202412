<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;

class CartItemController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $cartItems = CartItem::where('user_id', $userId)->with('item')->get();

        return view('mycart', compact('cartItems'));
    }

    public function store(Request $request)
    {
        $userId = auth()->id();
        $itemId = $request->input('item_id');

        $cartItem = CartItem::where('user_id', $userId)->where('item_id', $itemId)->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            CartItem::create([
                'user_id' => $userId,
                'item_id' => $itemId,
                'quantity' => 1,
            ]);
        }

        return response()->json(['message' => 'Item added to cart']);
    }

    public function destroy(CartItem $cartItem)
    {
        $cartItem->delete();

        return response()->json(['message' => 'Item removed from cart']);
    }
}




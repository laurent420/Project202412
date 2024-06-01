<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\ItemGroup;

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
    
        $group = ItemGroup::find($itemId);
    
        if (!$group) {
            return response()->json(['message' => 'Item not found'], 404);
        }
    
        if ($group->quantity < 1) {
            return response()->json(['message' => 'Item out of stock'], 400);
        }
    
        $cartItem = CartItem::where('user_id', $userId)->where('item_id', $itemId)->first();
    
        if ($cartItem) {
            if ($group->quantity < ($cartItem->quantity + 1)) {
                return response()->json(['message' => 'Not enough stock available'], 400);
            }
            $cartItem->increment('quantity');
        } else {
            CartItem::create([
                'user_id' => $userId,
                'item_id' => $itemId,
                'quantity' => 1,
            ]);
        }
    
        $group->decrement('quantity');
    
        return response()->json(['message' => 'Item added to bag']);
    }

    
    
public function destroy(Request $request, $itemId)
{
    $userId = auth()->id();
    $cartItem = CartItem::where('user_id', $userId)->where('item_id', $itemId)->first();

    if (!$cartItem) {
        return response()->json(['message' => 'Item not found in cart'], 404);
    }

    $item = ItemGroup::find($itemId);

    if ($cartItem->quantity > 1) {
        $cartItem->decrement('quantity');
        $item->increment('quantity');
    } else {
        $item->increment('quantity', $cartItem->quantity);
        $cartItem->delete();
    }

    return response()->json(['message' => 'Item removed from cart']);
}

    
    
    

}




<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\ItemGroup;
use App\Models\Cart;

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
        $groupId = $request->input('item_id');
        $group = ItemGroup::find($groupId);

        if ($group && $group->quantity > 0) {
            // Decrease the group's quantity
            $group->quantity -= 1;
            $group->save();

            // Add item to the cart
            $cart = new Cart();
            $cart->item_group_id = $groupId;
            $cart->save();

            return response()->json(['success' => 'Item added to cart', 'quantity' => $group->quantity]);
        } else {
            return response()->json(['error' => 'Item is out of stock'], 400);
        }
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




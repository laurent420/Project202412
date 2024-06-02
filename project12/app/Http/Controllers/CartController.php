<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemGroup;
use App\Models\Cart;
use App\Models\Lending;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
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
            $cart->user_id = Auth::id(); // Save the user ID
            $cart->save();

            return response()->json(['success' => 'Item added to cart', 'quantity' => $group->quantity]);
        } else {
            return response()->json(['error' => 'Item is out of stock'], 400);
        }
    }

    public function index()
    {
        // Get the cart items for the authenticated user
        $cartItems = Cart::with('itemGroup')->where('user_id', Auth::id())->get();

        // Pass the cart items to the view
        return view('mycart', ['cartItems' => $cartItems]);
    }

    public function remove($id)
    {
        // Find the cart item by ID and ensure it belongs to the authenticated user
        $cartItem = Cart::where('id', $id)->where('user_id', Auth::id())->first();

        if ($cartItem) {
            // Increase the group's quantity
            $itemGroup = $cartItem->itemGroup;
            $itemGroup->quantity += 1;
            $itemGroup->save();

            // Remove the item from the cart
            $cartItem->delete();

            return redirect()->route('MyCart')->with('success', 'Item removed from cart');
        } else {
            return redirect()->route('MyCart')->with('error', 'Item not found or you do not have permission to remove it');
        }
    }

    
    public function lend(Request $request)
    {
        $request->validate([
            'lend_date' => 'required|date|after:today',
        ]);

        $lendDate = $request->input('lend_date');
        $returnDate = date('Y-m-d', strtotime($lendDate . ' + 7 days'));
        $cartItems = Cart::with('itemGroup')->where('user_id', Auth::id())->get();

        // Check availability of each item for the specified period
        foreach ($cartItems as $cartItem) {
            $itemGroupId = $cartItem->item_group_id;

            $overlappingLendings = Lending::where('item_group_id', $itemGroupId)
                ->where(function ($query) use ($lendDate, $returnDate) {
                    $query->whereBetween('lend_date', [$lendDate, $returnDate])
                          ->orWhereBetween('return_date', [$lendDate, $returnDate])
                          ->orWhere(function ($query) use ($lendDate, $returnDate) {
                              $query->where('lend_date', '<=', $lendDate)
                                    ->where('return_date', '>=', $returnDate);
                          });
                })
                ->exists();

            if ($overlappingLendings) {
                return redirect()->route('Mycart')->with('error', 'One or more items are out of stock on the selected date.');
            }
        }

        // Deduct items from the inventory and create lendings
        foreach ($cartItems as $cartItem) {
            $itemGroup = $cartItem->itemGroup;
            $itemGroup->quantity -= 1;
            $itemGroup->save();

            Lending::create([
                'user_id' => Auth::id(),
                'item_group_id' => $itemGroup->id,
                'lend_date' => $lendDate,
                'return_date' => $returnDate,
            ]);

            $cartItem->delete(); // Remove the item from the cart
        }

        return redirect()->route('MyCart')->with('success', 'Items have been successfully lent.');
    }
}

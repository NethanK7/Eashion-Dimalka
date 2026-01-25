<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cartItems = Cart::with('product')
            ->where('user_id', $request->user()->id)
            ->get();

        return response()->json([
            'success' => true,
            'cart_items' => $cartItems
        ]);
    }

    public function store(Request $request){
        $user = $request->user();

        $cartItem = Cart::where('user_id', $user->id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity', $request->quantity ?? 1);
        } else {
            // New product → add to cart
            $cartItem = Cart::create([
                'user_id' => $user->id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity ?? 1,
            ]);
        }

        return response()->json([
            'success' => true,
            'cart_item' => $cartItem
        ]);
    }

    //Remove
    public function remove(Cart $cartItem){
        if($cartItem->user_id === auth()->id()){
            $cartItem->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Item removed'
        ]);
    }

    //Update
    public function update(Request $request, Cart $cartItem){
        if ($cartItem->user_id !== $request->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return response()->json([
            'success' => true,
            'cart_item' => $cartItem
        ]);
    }

}

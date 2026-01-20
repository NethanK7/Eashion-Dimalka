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
        $cartItem = Cart::create([
            'user_id' => $request->user()->id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
        ]);

        return response()->json([
            'success' => true,
            'cart_item' => $cartItem
        ]);
    }

    public function remove(Cart $cartItem){
        if($cartItem->user_id === auth()->id()){
            $cartItem->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Item removed'
        ]);
    }
}

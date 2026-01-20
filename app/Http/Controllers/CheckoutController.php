<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;


class CheckoutController extends Controller
{
    public function index()
    {
        $selectedIds = session('checkout_items', []);

        $query = Cart::where('user_id', Auth::id())->with('product');

        if (!empty($selectedIds)) {
            $query->whereIn('id', $selectedIds);
        }

        $cartItems = $query->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your selection is empty.');
        }

        $subtotal = 0;
        foreach ($cartItems as $item) {
            $price = $item->product->price * (1 - (($item->product->discount ?? 0) / 100));
            $subtotal += $price * $item->quantity;
        }

        return view('Frontend.check_out', compact('cartItems', 'subtotal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
        ]);

        session(['checkout_items' => $request->items]);

        return redirect()->route('checkout');
    }

    public function place(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'street_address' => 'required',
            'district' => 'required',
            'province' => 'required',
            'phone' => 'required',
        ]);

        $selectedIds = session('checkout_items', []);

        $order = DB::transaction(function () use ($request, $selectedIds) {

            $query = Cart::where('user_id', auth()->id())->with('product');
            
            if (!empty($selectedIds)) {
                $query->whereIn('id', $selectedIds);
            }

            $cartItems = $query->get();

            if ($cartItems->isEmpty()) {
                throw new \Exception('Cart is empty');
            }

            $subtotal = 0;
            foreach ($cartItems as $item) {
                $price = $item->product->price * (1 - (($item->product->discount ?? 0) / 100));
                $subtotal += $price * $item->quantity;
            }

            // Create Order
            $order = Order::create([
                'user_id' => auth()->id(),
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'street_address' => $request->street_address,
                'district' => $request->district,
                'province' => $request->province,
                'phone' => $request->phone,
                'subtotal' => $subtotal,
                'shipping' => 250,
                'total' => $subtotal + 250,
                'status' => 'pending',
            ]);

            // Create Order Items
            foreach ($cartItems as $item) {
                $price = $item->product->price * (1 - (($item->product->discount ?? 0) / 100));

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'price' => $price,
                    'quantity' => $item->quantity,
                    'discount' => $item->product->discount ?? 0,
                ]);
            }

            // Clear ONLY selected items from Cart for this user
            if (!empty($selectedIds)) {
                Cart::whereIn('id', $selectedIds)->where('user_id', auth()->id())->delete();
            } else {
                Cart::where('user_id', auth()->id())->delete();
            }
            
            session()->forget('checkout_items');
            
            return $order;
        });

        return redirect()->route('payhere.checkout', ['order' => $order->id]);
    }
}

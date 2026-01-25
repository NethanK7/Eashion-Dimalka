<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Log;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;

class PayhereController extends Controller
{
    public function checkout(Order $order)
    {
        $merchant_id = config('payhere.merchant_id');
        $merchant_secret = config('payhere.merchant_secret');
        $currency = config('payhere.currency', 'LKR');
        $amount = $order->total;
        $order_id = $order->id;

        $hash = strtoupper(
            md5(
                $merchant_id . 
                $order_id . 
                number_format($amount, 2, '.', '') . 
                $currency . 
                strtoupper(md5($merchant_secret))
            )
        );

        $payhere_url = config('payhere.mode') === 'sandbox' 
            ? 'https://sandbox.payhere.lk/pay/checkout' 
            : 'https://www.payhere.lk/pay/checkout';

        $payhere_data = [
            'merchant_id' => $merchant_id,
            'return_url' => config('payhere.return_url'),
            'cancel_url' => config('payhere.cancel_url'),
            'notify_url' => config('payhere.notify_url'),
            'order_id' => $order_id,
            'items' => 'Order from EASHION #' . $order_id,
            'currency' => $currency,
            'amount' => number_format($amount, 2, '.', ''),
            'first_name' => $order->first_name,
            'last_name' => $order->last_name,
            'email' => auth()->user()->email,
            'phone' => $order->phone,
            'address' => $order->street_address,
            'city' => $order->district,
            'country' => 'Sri Lanka',
            'hash' => $hash,
        ];

        return view('Frontend.payhere_redirect', compact('payhere_url', 'payhere_data'));
    }

    public function notify(Request $request)
    {
        $merchant_id = $request->merchant_id;
        $order_id = $request->order_id;
        $payhere_amount = $request->payhere_amount;
        $payhere_currency = $request->payhere_currency;
        $status_code = $request->status_code;
        $md5sig = $request->md5sig;

        $merchant_secret = config('payhere.merchant_secret');

        $local_md5sig = strtoupper(
            md5(
                $merchant_id . 
                $order_id . 
                $payhere_amount . 
                $payhere_currency . 
                $status_code . 
                strtoupper(md5($merchant_secret))
            )
        );

        if ($local_md5sig !== $md5sig || $status_code != 2) {
            Log::warning('PayHere payment failed', $request->all());
            return response()->json(['status' => 'failed'], 400);
        }

        $this->processOrder($order_id);

        return response()->json(['status' => 'success']);
    }

    public function return(Request $request)
    {
        // PayHere appends the order_id to the return URL
        $order_id = $request->get('order_id');

        if ($order_id) {
            $this->processOrder($order_id);
        }

        return redirect()->route('products.index')->with('success', 'Payment successful! Your order has been placed.');
    }

    public function cancel(Request $request)
    {
        return redirect()->route('checkout')->with('error', 'Payment was cancelled. You can try again.');
    }

    /**
     * Helper method to process order fulfillment (status update & stock reduction)
     */
    private function processOrder($order_id)
    {
        DB::transaction(function () use ($order_id) {
            $order = Order::with('items')->findOrFail($order_id);

            // If order is already processed, don't do it again
            if ($order->status === 'paid') {
                return;
            }

            // 1. Update order status
            $order->update([
                'status' => 'paid',
            ]);

            // 2. Reduce each product's stock
            foreach ($order->items as $item) {
                Product::where('id', $item->product_id)
                    ->decrement('stock_qty', $item->quantity);
            }

            // 3. Clear user's cart
            Cart::where('user_id', $order->user_id)->delete();
        });
    }
}

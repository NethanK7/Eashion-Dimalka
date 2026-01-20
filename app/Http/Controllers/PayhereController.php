<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Log;

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

        if (($local_md5sig === $md5sig) && ($status_code == 2)) {
            $order = Order::find($order_id);
            if ($order) {
                $order->update(['status' => 'paid']);
            }
        }

        return response()->json(['status' => 'success']);
    }

    public function return(Request $request)
    {
        return redirect()->route('products.index')->with('success', 'Payment successful! Your order has been placed.');
    }

    public function cancel(Request $request)
    {
        return redirect()->route('checkout')->with('error', 'Payment was cancelled. You can try again.');
    }
}

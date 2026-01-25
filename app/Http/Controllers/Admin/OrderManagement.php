<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderManagement extends Controller
{
    public function index(){
        $orders = Order::orderBy('created_at', 'desc')->get();
        return view('admin_panel.order_management', compact('orders'));
    }
}

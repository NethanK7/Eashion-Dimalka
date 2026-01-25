<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class CustomerManagement extends Controller
{
    public function index(){
        $customers = User::where('role_id', 2 )->get();
        return view('admin_panel.customer_management', compact('customers'));
    }
}

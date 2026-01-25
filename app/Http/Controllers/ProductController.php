<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        //Latest Products(4)
        $products = Product::latest()->take(4)->get();
        return view('Frontend.index', compact('products'));
    }

    public function showAllMen(){
        $products = Product::where('category_id',1)->paginate(8);
        return view('Frontend.men',compact('products'));
    }

    public function showAllWomen(){
        $products = Product::where('category_id',2)->paginate(8);
        return view('Frontend.women',compact('products'));
    }

    public function show($id){
        $product = Product::findOrFail($id);
        return view('Frontend.productdetails', compact('product'));
    }

    
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //API
    public function apiIndex(){
        $products = Product::with('category')
            ->latest()
            ->take(6)
            ->get()
            ->map(function ($product) {
                $product->image_url = $product->image_path;
                return $product;
            });

        return response()->json([
            'success' => true,
            'data' => $products
        ]);
    }

    public function DiscountProducts(){
        $products = Product::with('category')
            ->oldest()
            ->take(5)
            ->get()
            ->map(function ($product) {
                $product->image_url = $product->image_path;
                return $product;
            });

        return response()->json([
            'success' => true,
            'data' => $products
        ]);
    }



    public function byCategory(Request $request){
        $query = Product::with('category');

        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        return response()->json([
            'success' => true,
            'data' => $query->get()
        ]);
    }

    public function showDetails($id){
        $product = Product::with('category')->find($id);
        return response()->json([
            'success' => true,
            'data' => $product
        ]);
    }
}

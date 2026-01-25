<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;


class CategoryController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        $products = Product::all();
        return view('admin_panel.createP', compact('categories', 'products'));
    }

    public function testDatabase()
    {
        // Initialize Firebase with service account and database URL
    $factory = (new Factory)
        ->withServiceAccount(storage_path('app/firebase/firebase.json'))
        ->withDatabaseUri('https://eashion-default-rtdb.asia-southeast1.firebasedatabase.app/'); // <-- use your URL

    $firebase = $factory->createDatabase();

    // Reference a path in your database
    $reference = $firebase->getReference('test');

    // Write data
    $reference->set([
        'status' => 'Firebase connected successfully'
    ]);

    return response()->json(['message' => 'Data written to Firebase successfully']);
    }

}

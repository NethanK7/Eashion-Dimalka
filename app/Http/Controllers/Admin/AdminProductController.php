<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Kreait\Firebase\Factory;

class AdminProductController extends Controller
{
    /* --------------------------------
       Firebase Bucket Helper
    -------------------------------- */
    private function firebaseBucket()
    {
        $factory = (new Factory)
            ->withServiceAccount(storage_path('app/firebase/firebase.json'))
            ->withDefaultStorageBucket('eashion.firebasestorage.app');

        return $factory->createStorage()->getBucket();
    }

    /* --------------------------------
       INDEX
    -------------------------------- */
    public function index()
    {
        $products = Product::all();
        return view('admin_panel.dashboard', compact('products'));
    }

    /* --------------------------------
       STORE
    -------------------------------- */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'stock_qty' => 'required|integer|min:0',
            'category_id' => 'required',
        ]);

        $bucket = $this->firebaseBucket();

        // Upload image
        $imageFile = $request->file('image');
        $fileName = 'products/' . uniqid() . '.' . $imageFile->getClientOriginalExtension();

        $bucket->upload(
            fopen($imageFile->getRealPath(), 'r'),
            ['name' => $fileName]
        );

        $imageUrl = "https://firebasestorage.googleapis.com/v0/b/{$bucket->name()}/o/"
            . urlencode($fileName) . "?alt=media";

        $product = Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'stock_qty' => $request->stock_qty,
            'fit_type' => $request->fit_type,
            'image_path' => $imageUrl,
            'color' => $request->color,
            'size' => $request->size,
            'discount' => $request->discount,
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Product created successfully');
    }

    /* --------------------------------
       EDIT
    -------------------------------- */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('admin_panel.edit', compact('product', 'categories'));
    }

    /* --------------------------------
       UPDATE
    -------------------------------- */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $bucket = $this->firebaseBucket();

        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'stock_qty' => 'required|integer|min:0',
            'category_id' => 'required',
        ]);

        $imageUrl = $product->image_path;

        // If new image uploaded
        if ($request->hasFile('image')) {

            // Delete old image from Firebase
            if ($product->image_path) {
                $oldPath = urldecode(parse_url($product->image_path, PHP_URL_PATH));
                $oldPath = str_replace("/v0/b/{$bucket->name()}/o/", '', $oldPath);

                $bucket->object($oldPath)->delete();
            }

            // Upload new image
            $imageFile = $request->file('image');
            $fileName = 'products/' . uniqid() . '.' . $imageFile->getClientOriginalExtension();

            $bucket->upload(
                fopen($imageFile->getRealPath(), 'r'),
                ['name' => $fileName]
            );

            $imageUrl = "https://firebasestorage.googleapis.com/v0/b/{$bucket->name()}/o/"
                . urlencode($fileName) . "?alt=media";
        }

        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'stock_qty' => $request->stock_qty,
            'fit_type' => $request->fit_type,
            'image_path' => $imageUrl,
            'color' => $request->color,
            'size' => $request->size,
            'discount' => $request->discount,
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Product updated successfully');
    }

    /* --------------------------------
       DELETE
    -------------------------------- */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $bucket = $this->firebaseBucket();

        // Delete image from Firebase
        if ($product->image_path) {
            $path = urldecode(parse_url($product->image_path, PHP_URL_PATH));
            $path = str_replace("/v0/b/{$bucket->name()}/o/", '', $path);

            $bucket->object($path)->delete();
        }

        $product->delete();

        return redirect()->back()
            ->with('success', 'Product deleted successfully');
    }

    
}

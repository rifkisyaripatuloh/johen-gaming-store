<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->latest()
            ->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::latest()->get();

        return view('admin.products.create', compact('categories'));
    }
use App\Models\ProductPackage;

public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'price' => 'required',
        'thumbnail' => 'required|image',
        'type' => 'required|in:topup,account',
    ]);

    $image = $request->file('thumbnail')
        ->store('products', 'public');

    $product = Product::create([
        'category_id' => $request->category_id,
        'name' => $request->name,
        'slug' => Str::slug($request->name),
        'thumbnail' => $image,
        'price' => $request->price,
        'stock' => $request->stock,
        'type' => $request->type,
        'description' => $request->description,
    ]);

    // 🔥 SIMPAN PACKAGE
    if ($request->packages) {
        foreach ($request->packages as $pkg) {
            ProductPackage::create([
                'product_id' => $product->id,
                'name' => $pkg['name'],
                'price' => $pkg['price'],
                'stock' => $pkg['stock'],
            ]);
        }
    }

    return redirect()->route('admin.products.index')
        ->with('success', 'Product created');
}

    // 🔥 EDIT PAGE
    public function edit(Product $product)
    {
        $categories = Category::latest()->get();

        return view('admin.products.edit', compact('product', 'categories'));
    }
public function update(Request $request, Product $product)
{
    $product->update([
        'category_id' => $request->category_id,
        'name' => $request->name,
        'slug' => Str::slug($request->name),
        'price' => $request->price,
        'stock' => $request->stock,
        'type' => $request->type,
        'description' => $request->description,
    ]);

    // hapus package lama
    $product->packages()->delete();

    // insert ulang
    if ($request->packages) {
        foreach ($request->packages as $pkg) {
            $product->packages()->create([
                'name' => $pkg['name'],
                'price' => $pkg['price'],
                'stock' => $pkg['stock'],
            ]);
        }
    }

    return redirect()->route('admin.products.index')
        ->with('success', 'Product updated');
}

    // 🔥 DELETE PRODUCT
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product deleted');
    }
}
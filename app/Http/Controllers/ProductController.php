<?php 

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductPackage;
class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->latest()
            ->get();

        return view('products.index', compact('products'));
    }

   public function show($slug)
{
    $product = Product::with([
        'category',
        'packages',
        'attributes'
    ])->where('slug', $slug)->firstOrFail();

    $relatedProducts = Product::where('id', '!=', $product->id)
        ->latest()
        ->take(4)
        ->get();

    return view('products.show', compact(
        'product',
        'relatedProducts'
    ));
}
}
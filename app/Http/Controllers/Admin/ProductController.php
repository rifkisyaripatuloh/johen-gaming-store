<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductPackage;
use App\Models\GameAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LIST PRODUCT
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $products = Product::with([
                'category',
                'packages',
                'attributes'
            ])
            ->latest()
            ->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        $categories = Category::latest()->get();

        return view('admin.products.create', compact('categories'));
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'thumbnail' => 'required|image',
            'type' => 'required|in:topup,sell_account',
            'description' => 'nullable',
        ]);

        $thumbnail = $request->file('thumbnail')
            ->store('products', 'public');

      $product = Product::create([
    'category_id' => $request->category_id,
    'name' => $request->name,
    'slug' => Str::slug($request->name . '-' . time()),
    'thumbnail' => $thumbnail,

    'price' => $request->type == 'sell_account'
        ? $request->price
        : 0,
'stock' => $request->type == 'sell_account'
        ? 1
        : 0,

    'type' => $request->type,
    'description' => $request->description,
    'status' => 'available'
]);

        /*
        |--------------------------------------------------------------------------
        | TOPUP PACKAGE
        |--------------------------------------------------------------------------
        */
        if ($request->type === 'topup') {

            if ($request->packages) {

                foreach ($request->packages as $pkg) {

                    if (
                        empty($pkg['name']) &&
                        empty($pkg['price'])
                    ) {
                        continue;
                    }

                    ProductPackage::create([
                        'product_id' => $product->id,
                        'name'       => $pkg['name'],
                        'price'      => $pkg['price'],
                        'stock'      => $pkg['stock'] ?? 99999,
                    ]);
                }
            }
        }

        /*
        |--------------------------------------------------------------------------
        | ACCOUNT ATTRIBUTE
        |--------------------------------------------------------------------------
        */
        if ($request->type === 'sell_account') {

            if ($request->attributes) {

                foreach ($request->attributes as $attribute) {

                    if (
    empty($attribute['field_name']) &&
    empty($attribute['value'])
) {
    continue;
}

                    GameAttribute::create([
                      'product_id'  => $product->id,
    'field_name'  => $attribute['field_name'],
    'field_type'  => 'text',
    'options'     => [$attribute['value']],
    'sort_order'  => 0,
    'is_required' => false,
                    ]);
                }
            }
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product created successfully');
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */
    public function edit(Product $product)
    {
        $product->load([
            'packages',
            'attributes'
        ]);

        $categories = Category::latest()->get();

        return view(
            'admin.products.edit',
            compact(
                'product',
                'categories'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */
    public function update(
        Request $request,
        Product $product
    ) {

        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'type' => 'required|in:topup,sell_account'
        ]);

        $data = [
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'price' => $request->price ?? 0,
            'stock' => $request->stock ?? 0,
            'type' => $request->type,
            'description' => $request->description
        ];

        if ($request->hasFile('thumbnail')) {

            $data['thumbnail'] = $request
                ->file('thumbnail')
                ->store('products', 'public');
        }

        $product->update($data);

        /*
        |--------------------------------------------------------------------------
        | DELETE OLD DATA
        |--------------------------------------------------------------------------
        */
        $product->packages()->delete();
        $product->attributes()->delete();

        /*
        |--------------------------------------------------------------------------
        | UPDATE PACKAGE TOPUP
        |--------------------------------------------------------------------------
        */
        if ($request->type === 'topup') {

            if ($request->packages) {

                foreach ($request->packages as $pkg) {

                    if (
                        empty($pkg['name']) &&
                        empty($pkg['price'])
                    ) {
                        continue;
                    }

                    ProductPackage::create([
                        'product_id' => $product->id,
                        'name' => $pkg['name'],
                        'price' => $pkg['price'],
                        'stock' => $pkg['stock'] ?? 99999
                    ]);
                }
            }
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE ACCOUNT ATTRIBUTE
        |--------------------------------------------------------------------------
        */
        if ($request->type === 'sell_account') {

            if ($request->attributes) {

                foreach ($request->attributes as $attribute) {

                    if (
                        empty($attribute['label']) &&
                        empty($attribute['value'])
                    ) {
                        continue;
                    }

                    GameAttribute::create([
                        'product_id' => $product->id,
                        'label' => $attribute['label'],
                        'value' => $attribute['value']
                    ]);
                }
            }
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product updated successfully');
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */
    public function destroy(Product $product)
    {
        $product->packages()->delete();
        $product->attributes()->delete();

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product deleted successfully');
    }
}
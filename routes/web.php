<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| FRONTEND CONTROLLER
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserDashboardController;
/*
|--------------------------------------------------------------------------
| ADMIN CONTROLLER
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\auth\AuthController;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');
    Route::get('/lang/{locale}', function ($locale) {

    if (in_array($locale, ['en', 'id'])) {

        Session::put('locale', $locale);

    }

    return redirect()->back();

})->name('lang.switch');

Route::get('/login', fn () => view('auth.login'))->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', fn () => view('auth.register'));
Route::post('/register', [AuthController::class, 'register']);
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

  

/*
|--------------------------------------------------------------------------
| PRODUCTS
|--------------------------------------------------------------------------
*/

Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');

Route::get('/products/{slug}', [ProductController::class, 'show'])
    ->name('products.show');

/*
|--------------------------------------------------------------------------
| AUTH USER
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    /*
    |--------------------------------------------------------------------------
    | CART
    |--------------------------------------------------------------------------
    */
    Route::get('/cart', [CartController::class, 'index'])
        ->name('cart.index');

    Route::post('/cart', [CartController::class, 'store'])
        ->name('cart.store');

    // ✅ MULTI CHECKOUT (HARUS POST)
    Route::post('/cart/checkout-selected', [CartController::class, 'checkoutSelected'])
        ->name('cart.checkout.selected');

    // DELETE ITEM
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])
        ->whereNumber('id')
        ->name('cart.destroy');

    /*
    |--------------------------------------------------------------------------
    | CHECKOUT
    |--------------------------------------------------------------------------
    */

    // Route::get('/checkout/{slug}', [CheckoutController::class, 'index'])
//        ->name('checkout.index');
// CHECKOUT view (hasil order)
Route::get('/checkout/{order}', [CheckoutController::class, 'checkoutView'])
    ->name('checkout.view');

Route::post('/checkout/process', [CheckoutController::class, 'process'])
    ->name('checkout.process');

    /*
    |--------------------------------------------------------------------------
    | ORDERS
    |--------------------------------------------------------------------------
    */
Route::get('/my-orders', [OrderController::class, 'index'])
    ->name('orders.index');

Route::get('/dashboard', [UserDashboardController::class, 'index'])
    ->name('dashboard');




// PAYMENT
Route::get('/payment/{order}', [CheckoutController::class, 'show'])
    ->name('payment.show');
    Route::post('/payment/{order}/confirm', [CheckoutController::class, 'confirmPayment'])
    ->name('payment.confirm');
    Route::post('/payment/{order}/paid', [CheckoutController::class, 'paid'])
    ->name('payment.paid');
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTE
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

    




    
        /*
        |--------------------------------------------------------------------------
        | CATEGORY
        |--------------------------------------------------------------------------
        */

        Route::resource('categories', CategoryController::class);

        /*
        |--------------------------------------------------------------------------
        | PRODUCT
        |--------------------------------------------------------------------------
        */

        Route::resource('products', AdminProductController::class);

        /*
        |--------------------------------------------------------------------------
        | ORDER
        |--------------------------------------------------------------------------
        */

        Route::resource('orders', AdminOrderController::class);

        /*
        |--------------------------------------------------------------------------
        | BANNER
        |--------------------------------------------------------------------------
        */

        Route::resource('banners', BannerController::class);

        /*
        |--------------------------------------------------------------------------
        | VOUCHER
        |--------------------------------------------------------------------------
        */

        Route::resource('vouchers', VoucherController::class);


        /*
        |--------------------------------------------------------------------------
        | cart
        |--------------------------------------------------------------------------
        */
           Route::get('/cart', [CartController::class, 'index'])
        ->name('cart.index');

    Route::post('/cart', [CartController::class, 'store'])
        ->name('cart.store');

    Route::delete('/cart/{id}', [CartController::class, 'destroy'])
        ->name('cart.destroy');

   /*
        |--------------------------------------------------------------------------
        | payment
        |--------------------------------------------------------------------------
        */

        
});




/*
|--------------------------------------------------------------------------
| FALLBACK
|--------------------------------------------------------------------------
*/

Route::fallback(function () {

    return view('errors.404');

});
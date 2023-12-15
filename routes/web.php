<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', [CartController::class, 'index'])->name('dashboard');
    Route::get('cart', [CartController::class, 'cart'])->name('cart');
    Route::get('checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::get('confirmation', [CartController::class, 'confirmation'])->name('confirmation');
    Route::get('productview', [CartController::class, 'productview'])->name('productview');

    Route::get('product/{id}', [CartController::class, 'addProducttoCart'])->name('addcart');
    Route::patch('updatecart', [CartController::class, 'updateCart'])->name('updatecart');
    Route::delete('deletecart', [CartController::class, 'deleteProduct'])->name('deletecart');

});

Route::group(['middleware' => ['auth','admin'],'prefix' => 'webadmin'], function () {
    Route::get('home', [HomeController::class, 'adminHome']);
    Route::resource('products', ProductController::class);
 });




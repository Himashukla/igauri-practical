<?php


use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/products', 'ProductsController@index')->name('products.index');
Route::get('/add-cart-item', 'ProductsController@addCartItem')->name('add.cart');
Route::get('/show-cart', 'ProductsController@showCart')->name('show.cart');
Route::get('/update-cart-item', 'ProductsController@updateCartItem')->name('update.cart');
Route::get('/delete-cart-item', 'ProductsController@deleteCartItem')->name('delete.cart');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

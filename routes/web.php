<?php

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
    return view('welcome');
});

# Add Products
Route::post('/add-product','ProductController@addProduct');
# Get All Products with Images
Route::get('/get-products','ProductController@getProducts');
# Add to Cart
Route::post('/add-to-cart','ProductController@addToCart');
# View Cart Items
Route::get('/view-cart-items','ProductController@getCartItems');
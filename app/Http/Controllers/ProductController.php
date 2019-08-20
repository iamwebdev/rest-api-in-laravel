<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductDetails;
use App\Product;
use Session;

class ProductController extends Controller
{
    public function addProduct(Request $request)
    {
    	$product = new Product;
    	$product->name = $request->name;
    	$product->price = $request->price;
    	$product->save();
    	if(!empty($request->images)) {
	        foreach ($request->images as $key => $value) {
	            if(!empty($value))
	            {
    				$productDetails = new ProductDetails;
    				$productDetails->product_id = $product->id;
	                $documentFileName = uniqid().$value->getClientOriginalName();
	                $value->move('images',$documentFileName);
	                $productDetails->image = 'images/'.$documentFileName;
	                $productDetails->save();
	            }                        
	        }
	    } 
    	return response()->json('Saved');
    }

    public function getProducts()
    {
    	$products = Product::join('product_details','product_details.product_id','products.id')->get();
    	return response()->json($products);
    }	

    public function addToCart(Request $request)
    {
        $objProduct = new Product;
        $product = $objProduct->getProductById($request->product_id);
        $cartItems = Session::get('cart-items')?Session::get('cart-items'):array();
        $cartItems[$request->product_id] = array(
            'pro_id' => $product->pluck('productId')->first(),
            'name' => $product->pluck('name')->first(),
            'image' => $product->pluck('image'),
            'price' => $product->pluck('price')->first(),
            'user_id' => '1'
        );   
        Session::put('cart-items', $cartItems);
        Session::save(); 
        return response()->json($cartItems);
    }

    public function getCartItems()
    {
        $cartItems = Session::get('cart-items');    
     	return response()->json($cartItems);
    }
}

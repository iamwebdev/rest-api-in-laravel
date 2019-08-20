<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function getProductById($productId)
    {
    	return Product::leftjoin('product_details','product_details.product_id','products.id')->select('products.*','product_details.*','products.id as productId')->where('products.id',$productId)->get();
    }
}

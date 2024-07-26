<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\OrderRate;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        $collection = Product::where('categories_id','=',$product->categories_id)
        ->where('id','!=',$product->id)
        ->get();
        $avg = OrderRate::select(DB::raw('AVG(rates) AS avg'))
        ->where('product_id',$product->id)
        ->first();
        return view('page.user.product.show',compact('product','collection', 'avg'));
    }
}

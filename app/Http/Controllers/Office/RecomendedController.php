<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RecomendedController extends Controller
{
    public function recomendation(Product $product,$id)
    {
        $product = Product::where('id',$id)->first();
        $product->recomend = 'y';
        $product->update();
        return response()->json([
            'alert' => 'success',
            'message' => 'Product ' . $product->titles . ' Recomended',
        ]);
    }

    public function unrecomendation(Product $product,$id)
    {
        $product = Product::where('id',$id)->first();
        $product->recomend = 'n';
        $product->update();
        return response()->json([
            'alert' => 'success',
            'message' => 'Product ' . $product->titles . ' Cancel Recomended',
        ]);
    }
}
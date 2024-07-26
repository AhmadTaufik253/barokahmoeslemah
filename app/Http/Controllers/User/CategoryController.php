<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $keywords = $request->keywords;
            $collection = Category::where('titles','like','%'.$keywords.'%')
            ->paginate(10);
            return view('page.user.category.list', compact('collection'));
        }
        return view('page.user.category.main');
    }
    public function show(Request $request, Category $category)
    {
        if ($request->ajax()) {
            $keywords = $request->keywords;
            $collection = Product::where('categories_id','=',$category->id)
            ->where('titles','like','%'.$keywords.'%')
            ->paginate(10);
            return view('page.user.category.show_list', compact('collection'));
        }
        return view('page.user.category.show',compact('category'));
    }
}

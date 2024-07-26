<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $keywords = $request->keywords;
            $collection = Category::where('titles','like','%'.$keywords.'%')
            ->paginate(10);
            return view('page.office.category.list', compact('collection'));
        }
        return view('page.office.category.main');
    }
    public function create()
    {
        return view('page.office.category.input', ["category" => new Category]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titles' => 'required|unique:categories',
            'photo' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('titles')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('titles'),
                ]);
            }else{
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('photo'),
                ]);
            }
        }
        $file = request()->file('photo')->store("category");
        $category = new Category;
        $category->titles = Str::title($request->titles);
        $category->slug = Str::slug($request->titles);
        $category->photo = $file;
        $category->save();
        return response()->json([
            'alert' => 'success',
            'message' => 'Category '. $request->titles . ' Saved',
        ]);
    }
    public function show(Category $category)
    {
        //
    }
    public function edit(Category $category)
    {
        return view('page.office.category.input', compact('category'));
    }
    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'titles' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('titles')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('titles'),
                ]);
            }
        }
        if(request()->file('photo')){
            Storage::delete($category->photo);
            $file = request()->file('photo')->store("category");
            $category->photo = $file;
        }
        $category->titles = Str::title($request->titles);
        $category->update();
        return response()->json([
            'alert' => 'success',
            'message' => 'Category '. $request->titles . ' Updated',
        ]);
    }
    public function destroy(Category $category)
    {
        $product = Product::where('categories_id',$category->id)->get();
        foreach($product AS $item){
            Storage::delete($item->photo);
            $item->delete();
        }
        Storage::delete($category->photo);
        $category->delete();
        return response()->json([
            'alert' => 'success',
            'message' => 'Category '. $category->titles . ' Deleted',
        ]);
    }
    public function download(Category $category)
    {
        $extension = Str::of($category->photo)->explode('.');
        return Storage::download($category->photo, $category->titles.'.'.$extension[1]);
    }
}

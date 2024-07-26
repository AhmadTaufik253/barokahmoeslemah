<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $keywords = $request->keywords;
            $collection = Banner::where('title','like','%'.$keywords.'%')
            ->paginate(10);
            return view('page.office.banner.list', compact('collection'));
        }
        return view('page.office.banner.main');
    }
    public function create()
    {
        return view('page.office.banner.input', ["banner" => new Banner]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:banners',
            'description' => 'required',
            'photo' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('title')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('title'),
                ]);
            }elseif ($errors->has('description')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('description'),
                ]);
            }else{
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('photo'),
                ]);
            }
        }
        $file = request()->file('photo')->store("banner");
        $banner = new Banner;
        $banner->title = Str::title($request->title);
        $banner->description = Str::title($request->description);
        $banner->photo = $file;
        $banner->save();
        return response()->json([
            'alert' => 'success',
            'message' => 'Banner '. $request->title . ' Saved',
        ]);
    }
    public function show(Banner $banner)
    {
        // 
    }
    public function edit(Banner $banner)
    {
        return view('page.office.banner.input', compact('banner'));
    }
    public function update(Request $request, Banner $banner)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('title')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('title'),
                ]);
            }elseif ($errors->has('description')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('description'),
                ]);
            }
        }
        if(request()->file('photo')){
            Storage::delete($banner->photo);
            $file = request()->file('photo')->store("banner");
            $banner->photo = $file;
        }
        $banner->title = Str::title($request->title);
        $banner->description = Str::title($request->description);
        $banner->update();
        return response()->json([
            'alert' => 'success',
            'message' => 'Banner '. $request->title . ' Updated',
        ]);
    }
    public function destroy(Banner $banner)
    {
        Storage::delete($banner->photo);
        $banner->delete();
        return response()->json([
            'alert' => 'success',
            'message' => 'Banner '. $banner->title . ' Deleted',
        ]);
    }
}

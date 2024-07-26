<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

class WebController extends Controller
{
    public function index()
    {
        $inspiring = Inspiring::quote();
        return view('page.user.home.main',compact('inspiring'));
    }
    public function about()
    {
        return view('page.user.home.about');
    }
}

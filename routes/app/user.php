<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\CityController;
use App\Http\Controllers\User\ProvinceController;
use App\Http\Controllers\User\SubdistrictController;
use App\Http\Controllers\User\WebController AS WebC;
use App\Http\Controllers\User\CartController AS CartC;
use App\Http\Controllers\User\OrderController AS OrderC;
use App\Http\Controllers\User\ProductController AS ProductC;
use App\Http\Controllers\User\CategoryController AS CategoryC;

Route::group(['domain' => ''], function() {
    Route::prefix('')->name('user.')->group(function(){
        Route::redirect('/', 'home', 301);
        Route::get('account/verify/{token}', [AuthController::class, 'verify'])->name('verify'); 
        Route::get('home', [WebC::class, 'index'])->name('home');
        Route::get('category', [CategoryC::class, 'index'])->name('category.index');
        Route::get('category/{category:slug}', [CategoryC::class, 'show'])->name('category.show');
        Route::get('about', [WebC::class, 'about'])->name('about');
        Route::get('product', [ProductC::class, 'index'])->name('product.index');
        Route::get('product/{product:slug}', [ProductC::class, 'show'])->name('product.show');
        Route::get('auth',[AuthController::class, 'index'])->name('auth.index');
        Route::prefix('auth/')->name('auth.')->group(function(){
            Route::post('login',[AuthController::class, 'do_login'])->name('login');
            Route::post('register',[AuthController::class, 'do_register'])->name('register');
            Route::post('forgot',[AuthController::class, 'do_forgot'])->name('forgot');
            Route::get('reset/{token}',[AuthController::class, 'reset'])->name('get.reset');
            Route::post('reset',[AuthController::class, 'do_reset'])->name('reset');
        });
        
        Route::get('province/list',[ProvinceController::class, 'list'])->name('province.get');
        Route::get('city/list',[CityController::class, 'list'])->name('city.get');
        Route::get('subdistrict/list',[SubdistrictController::class, 'list'])->name('subdistrict.get');
        Route::get('order/ongkir',[OrderC::class, 'ongkir'])->name('ongkir.get');
        Route::post('city/get_list',[CityController::class, 'get_list'])->name('city.get_list');
        Route::post('subdistrict/get_list',[SubdistrictController::class, 'get_list'])->name('subdistrict.get_list');    
        
        Route::middleware(['auth'])->group(function(){
            Route::get('profile',[AuthController::class, 'profile'])->name('auth.profile');
            Route::get('profile/{user:id}/edit',[AuthController::class, 'edit_profile'])->name('auth.edit');
            Route::post('profile/{user}/update',[AuthController::class, 'update_profile'])->name('auth.update');
            Route::get('logout',[AuthController::class, 'do_logout'])->name('auth.logout');
            Route::get('checkout', [CartC::class, 'index'])->name('cart.index');
            Route::post('checkout/store', [OrderC::class, 'store'])->name('checkout.store');
            Route::patch('order/{order}/cancel', [OrderC::class, 'cancel'])->name('order.cancel');
            Route::patch('order/{order}/receive', [OrderC::class, 'receive'])->name('order.receive');
            Route::post('order/{order}/review', [OrderC::class, 'review'])->name('order.review');
            Route::post('order/{order}/doreview', [OrderC::class, 'do_review'])->name('order.do_review');
            Route::get('order/{order}/pdf', [OrderC::class, 'pdf'])->name('order.pdf');
            Route::get('cart/list', [CartC::class, 'list'])->name('cart.list');
            Route::delete('cart/{cart}/delete', [CartC::class, 'destroy'])->name('cart.destroy');
            Route::post('cart/store', [CartC::class, 'store'])->name('cart.store');
        });

        Route::group(['middleware' => ['auth:web','verified']], function () {
            
        });
    });
});
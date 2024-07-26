<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Office\AuthController;
use App\Http\Controllers\Office\DashboardController AS DashboardC;
use Office\BannerController AS BannerC;
use Office\CategoryController AS CategoryC;
use Office\ProductController AS ProductC;
use Office\CustomerController AS CustomerC;
use Office\EmployeeController AS EmployeeC;
use Office\OrderController AS OrderC;
// use App\Http\Controllers\Office\RecomendedController as RecomendedC;
// use Office\RecomendedController AS RecomendedC;
use App\Http\Controllers\Office\RecomendedController;

Route::group(['domain' => ''], function() {
    Route::prefix('office/')->name('office.')->group(function(){
        Route::get('auth',[AuthController::class, 'index'])->name('auth.index');
        Route::prefix('auth')->name('auth.')->group(function(){
            Route::post('login',[AuthController::class, 'do_login'])->name('login');
            Route::post('register',[AuthController::class, 'do_register'])->name('register');
            Route::post('forgot',[AuthController::class, 'do_forgot'])->name('forgot');
            Route::post('reset',[AuthController::class, 'do_reset'])->name('reset');
        });

        Route::middleware(['auth:office'])->group(function(){
            Route::get('verification',[AuthController::class, 'verification'])->name('auth.verification');
            Route::post('verify/{auth:email}',[AuthController::class, 'do_verify'])->name('auth.verify');
            Route::get('logout',[AuthController::class, 'do_logout'])->name('auth.logout');
            Route::post('order/pdf', [\App\Http\Controllers\Office\OrderController::class, 'pdf'])->name('order.pdf');
            Route::get('order/{order}/invoice', [\App\Http\Controllers\Office\OrderController::class, 'invoice'])->name('order.invoice');
            Route::get('generate/pdf', [\App\Http\Controllers\Office\CustomerController::class, 'pdf'])->name('generate.pdf');
        });

        Route::group(['middleware' => ['auth:office']], function () {
            Route::redirect('/', 'dashboard', 301);
            Route::get('dashboard', [DashboardC::class, 'index'])->name('dashboard');
            Route::resource('banner', BannerC::class);
            Route::resource('category', CategoryC::class);
            Route::resource('product', ProductC::class);
            Route::patch('recomendation/{id}',[RecomendedController::class,'recomendation','__invoke'])->name('product.recomendation');
            Route::patch('unrecomendation/{id}',[RecomendedController::class,'unrecomendation','__invoke'])->name('product.unrecomendation');
            Route::resource('customer', CustomerC::class);
            Route::resource('employee', EmployeeC::class);
            Route::resource('order', OrderC::class);
            Route::get('order/{order}/download', [\App\Http\Controllers\Office\OrderController::class, 'download'])->name('order.download');
            Route::patch('order/{order}/reject', [\App\Http\Controllers\Office\OrderController::class, 'reject'])->name('order.reject');
            Route::patch('order/{order}/acc', [\App\Http\Controllers\Office\OrderController::class, 'acc'])->name('order.acc');
        });
    });
});

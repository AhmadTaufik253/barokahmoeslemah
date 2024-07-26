<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Http\Controllers';

    public const HOME = '/';
    public const DASHBOARD = '/office/dashboard';

    public function boot()
    {
        //

        parent::boot();
    }
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapOfficeRoutes();
        
        $this->mapUserRoutes();

        //
    }
    protected function mapOfficeRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/app/office.php'));
    }
    protected function mapUserRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/app/user.php'));
    }
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }
}

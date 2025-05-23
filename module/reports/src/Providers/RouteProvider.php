<?php

namespace Reports\Providers;
use App\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
class RouteProvider extends ServiceProvider
{
    protected $namespace ='Reports\Http\Controllers';

    public function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
    }

    public function map()
    {
        $this->mapWebRoutes();
        $this->mapApiRoutes();
    }

    public function mapWebRoutes()
    {
        Route::group([
            'midleware'=>['web'],
            'namespace'=>$this->namespace
        ], function($router){
            require __DIR__.'/../../routes/web.php';
        });
    }

    public function mapApiRoutes()
    {
        Route::group([
            'midleware'=>'api',
            'namespace'=>$this->namespace,
            'prefix'=>'api'
        ], function($router){
            require __DIR__.'/../../routes/api.php';
        });
    }
}

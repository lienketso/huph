<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'reports';

Route::group(['prefix'=>$adminRoute],function(Router $router) use($adminRoute,$moduleRoute){
    $router->group(['prefix'=>$moduleRoute],function(Router $router) use ($adminRoute,$moduleRoute){
        $router->get('index','ReportsController@getIndex')
            ->name('wadmin::reports.index.get')
            ->middleware('permission:reports_index');
        $router->get('posts/{id}','ReportsController@getPost')
            ->name('wadmin::reports.posts.get')
            ->middleware('permission:reports_index');
    });
});

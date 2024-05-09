<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'menu';
$moduleMobileRoute = 'menu-mobile';

Route::group(['prefix'=>$adminRoute],function(Router $router) use($adminRoute,$moduleRoute){
    $router->group(['prefix'=>$moduleRoute],function(Router $router) use ($adminRoute,$moduleRoute){
        $router->get('index','MenuController@getIndex')
            ->name('wadmin::menu.index.get')->middleware('permission:menu_index');
        $router->post('index','MenuController@postIndex')
            ->name('wadmin::menu.index.post')->middleware('permission:menu_index');
        $router->get('create','MenuController@getCreate')
            ->name('wadmin::menu.create.get')->middleware('permission:menu_create');
        $router->post('create','MenuController@postCreate')
            ->name('wadmin::menu.create.post')->middleware('permission:menu_create');
        $router->get('edit/{id}','MenuController@getEdit')
            ->name('wadmin::menu.edit.get')->middleware('permission:menu_edit');
        $router->post('edit/{id}','MenuController@postEdit')
            ->name('wadmin::menu.edit.post')->middleware('permission:menu_edit');
        $router->get('remove/{id}','MenuController@remove')
            ->name('wadmin::menu.remove.get')->middleware('permission:menu_delete');
        $router->get('change/{id}','MenuController@changeStatus')
            ->name('wadmin::menu.change.get');
    });
});

Route::group(['prefix'=>$adminRoute],function(Router $router) use($adminRoute,$moduleMobileRoute){
    $router->group(['prefix'=>$moduleMobileRoute],function(Router $router) use ($adminRoute,$moduleMobileRoute){
        $router->get('index','MobileMenuController@getIndex')
            ->name('wadmin::menu-mobile.index.get')->middleware('permission:menu_index');
        $router->post('index','MobileMenuController@postIndex')
            ->name('wadmin::menu-mobile.index.post')->middleware('permission:menu_index');
        $router->get('edit/{id}','MobileMenuController@getEdit')
            ->name('wadmin::menu-mobile.edit.get')->middleware('permission:menu_edit');
        $router->post('edit/{id}','MobileMenuController@postEdit')
            ->name('wadmin::menu-mobile.edit.post')->middleware('permission:menu_edit');

    });
});


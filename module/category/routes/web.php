<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'category';
$TuyensinhRoute = 'addmission';

Route::group(['prefix'=>$adminRoute],function(Router $router) use($adminRoute,$moduleRoute){
    $router->group(['prefix'=>$moduleRoute],function(Router $router) use ($adminRoute,$moduleRoute){
        $router->get('index','CategoryController@getIndex')
            ->name('wadmin::category.index.get')->middleware('permission:category_index');
        $router->get('create','CategoryController@getCreate')
            ->name('wadmin::category.create.get')->middleware('permission:category_create');
        $router->post('create','CategoryController@postCreate')
            ->name('wadmin::category.create.post')->middleware('permission:category_create');
        $router->get('edit/{id}','CategoryController@getEdit')
            ->name('wadmin::category.edit.get')->middleware('permission:category_edit');
        $router->post('edit/{id}','CategoryController@postEdit')
            ->name('wadmin::category.edit.post')->middleware('permission:category_edit');
        $router->get('remove/{id}','CategoryController@remove')
            ->name('wadmin::category.remove.get')->middleware('permission:category_delete');
        $router->get('change/{id}','CategoryController@changeStatus')
            ->name('wadmin::category.change.get');
    });
});
//Danh mục tuyển sinh
Route::group(['prefix'=>$adminRoute],function(Router $router) use($adminRoute,$TuyensinhRoute){
    $router->group(['prefix'=>$TuyensinhRoute],function(Router $router) use ($adminRoute,$TuyensinhRoute){
        $router->get('index','AddmissionCategoryController@getIndex')
            ->name('wadmin::cat-addmission.index.get')->middleware('permission:cat_addmission_index');
        $router->get('create','AddmissionCategoryController@getCreate')
            ->name('wadmin::cat-addmission.create.get')->middleware('permission:cat_addmission_create');
        $router->post('create','AddmissionCategoryController@postCreate')
            ->name('wadmin::cat-addmission.create.post')->middleware('permission:cat_addmission_create');
        $router->get('edit/{id}','AddmissionCategoryController@getEdit')
            ->name('wadmin::cat-addmission.edit.get')->middleware('permission:cat_addmission_edit');
        $router->post('edit/{id}','AddmissionCategoryController@postEdit')
            ->name('wadmin::cat-addmission.edit.post')->middleware('permission:cat_addmission_edit');
        $router->get('remove/{id}','AddmissionCategoryController@remove')
            ->name('wadmin::cat-addmission.remove.get')->middleware('permission:cat_addmission_delete');
        $router->get('change/{id}','AddmissionCategoryController@changeStatus')
            ->name('wadmin::cat-addmission.change.get');
    });
});

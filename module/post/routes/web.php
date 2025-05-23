<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'post';

Route::group(['prefix'=>$adminRoute],function(Router $router) use($adminRoute,$moduleRoute){
    $router->group(['prefix'=>$moduleRoute],function(Router $router) use ($adminRoute,$moduleRoute){
        $router->get('index','PostsController@getIndex')
            ->name('wadmin::post.index.get')->middleware('permission:post_index');
        $router->get('create','PostsController@getCreate')
            ->name('wadmin::post.create.get')->middleware('permission:post_create');
        $router->post('create','PostsController@postCreate')
            ->name('wadmin::post.create.post')->middleware('permission:post_create');
        $router->get('edit/{id}','PostsController@getEdit')
            ->name('wadmin::post.edit.get')->middleware('permission:post_edit');
        $router->post('edit/{id}','PostsController@postEdit')
            ->name('wadmin::post.edit.post')->middleware('permission:post_edit');
        $router->get('remove/{id}','PostsController@remove')
            ->name('wadmin::post.remove.get')->middleware('permission:post_delete');
        $router->get('change/{id}','PostsController@changeStatus')
            ->name('wadmin::post.change.get');
        $router->get('clone/{id}','PostsController@ClonePost')
            ->name('wadmin::post.clone.get');

    });
});

$moduleRoute2 = 'tuyen-sinh';
Route::group(['prefix'=>$adminRoute],function(Router $router) use($adminRoute,$moduleRoute2){
    $router->group(['prefix'=>$moduleRoute2],function(Router $router) use ($adminRoute,$moduleRoute2){

        $router->get('index','AdmissionController@getIndexProduct')
    ->name('wadmin::tuyen-sinh.index.get')->middleware('permission:addmission_index');
        $router->get('create','AdmissionController@getCreateProduct')
    ->name('wadmin::tuyen-sinh.create.get')->middleware('permission:addmission_create');
        $router->post('create','AdmissionController@postCreateProduct')
    ->name('wadmin::tuyen-sinh.create.post')->middleware('permission:addmission_create');
        $router->get('edit/{id}','AdmissionController@getEditProduct')
    ->name('wadmin::tuyen-sinh.edit.get')->middleware('permission:addmission_edit');
        $router->post('edit/{id}','AdmissionController@postEditProduct')
    ->name('wadmin::tuyen-sinh.edit.post')->middleware('permission:addmission_edit');
        $router->get('clone/{id}','AdmissionController@cloneProduct')
    ->name('wadmin::tuyen-sinh.clone.get')->middleware('permission:addmission_edit');
        $router->get('remove/{id}','AdmissionController@removeTuyensinh')
    ->name('wadmin::tuyen-sinh.remove.get')->middleware('permission:addmission_delete');
    });
});
//comment
Route::get('comment/index','CommentController@getIndex')
    ->name('wadmin::comment.index.get')->middleware('permission:post_index');
Route::get('/comment/create','CommentController@getCreate')
    ->name('wadmin::comment.create.get');

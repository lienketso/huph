<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'scores';

Route::group(['prefix'=>$adminRoute],function(Router $router) use($adminRoute,$moduleRoute){
    $router->group(['prefix'=>$moduleRoute],function(Router $router) use ($adminRoute,$moduleRoute){
        $router->post('import','ScoresController@import')
            ->name('wadmin::scores.import.post')
            ->middleware('permission:scores_index');
        $router->get('index','ScoresController@getIndex')
            ->name('wadmin::scores.index.get')->middleware('permission:scores_index');
        $router->post('index','ScoresController@postIndex')
            ->name('wadmin::scores.index.post')->middleware('permission:scores_index');
        $router->get('create','ScoresController@getCreate')
            ->name('wadmin::scores.create.get')->middleware('permission:scores_create');
        $router->post('create','ScoresController@postCreate')
            ->name('wadmin::scores.create.post')->middleware('permission:scores_create');
        $router->get('edit/{id}','ScoresController@getEdit')
            ->name('wadmin::scores.edit.get')->middleware('permission:scores_edit');
        $router->post('edit/{id}','ScoresController@postEdit')
            ->name('wadmin::scores.edit.post')->middleware('permission:scores_edit');
        $router->get('remove/{id}','ScoresController@remove')
            ->name('wadmin::scores.remove.get')->middleware('permission:scores_delete');
        //remove all
        $router->post('delete-mutilple','ScoresController@deleteMultiple')->name('wadmin::score-delete-multiple.post')
            ->middleware('permission:scores_delete');
    });
});

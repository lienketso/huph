<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$postRoute = 'post';

Route::group(['prefix' => $postRoute], function(Router $router) use ($postRoute) {
    $router->get('change-category-value', 'ApiPostController@changeCategory')->name('ajax.change.category.get');
    $router->post('ajax-auto-save-post','ApiPostController@saveDraft')->name('ajax.save-post.get');
});



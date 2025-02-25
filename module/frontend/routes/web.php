<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$FrontRoute = 'frontend';
$moduleRoute = 'home';

Route::get('/', 'HomeController@getIndex')->name('frontend::home');
Route::get('lang/{lang}', 'HomeController@changeLang')->name('frontend::lang');
Route::get('about', 'HomeController@about')->name('frontend::about.detail.get');



Route::group(['prefix'=>'solution'],function(Router $router){
    $router->get('/','ProjectController@index')
        ->name('frontend::solution.index.get');
    $router->get('{slug}','ProjectController@detail')
        ->name('frontend::solution.detail.get');
});

Route::group(['prefix'=>'category'],function(Router $router){
    $router->get('/','CategoryController@index')
        ->name('frontend::category.index.get');
    $router->get('{slug}','ProductController@index')
        ->name('frontend::product.index.get');
});

Route::group(['prefix'=>'product'],function(Router $router){
   $router->get('{slug}','ProductController@detail')
       ->name('frontend::product.detail.get');
});

Route::group(['prefix'=>'page'],function(Router $router){
    $router->get('{slug}','BlogController@page')
        ->name('frontend::page.index.get');
});


Route::group(['prefix'=>'post'],function(Router $router){
    $router->get('{slug}','BlogController@detail')
        ->name('frontend::blog.detail.get');
});
Route::group(['prefix'=>'blog'],function(Router $router){
    $router->get('{slug}','BlogController@index')
        ->name('frontend::blog.index.get');
    //ajax load more
    $router->get('{slug}/load-more-blog','BlogController@loadMoreData')
        ->name('frontend::blog.load-more.get');
});


//tags
Route::group(['prefix'=>'tags'],function(Router $router){
    $router->get('{slug}','BlogController@tags')
        ->name('frontend::tags.index.get');
    //ajax load more
    $router->get('{slug}/load-more-blog','BlogController@loadMoreData')
        ->name('frontend::blog.load-more.get');
});

Route::group(['prefix'=>'search'],function(Router $router){
    $router->get('/','BlogController@search')
        ->name('frontend::blog.search.get');
});

Route::group(['prefix'=>'contact'],function(Router $router){
    $router->get('/','HomeController@contact')
        ->name('frontend::home.contact.get');
    $router->post('/','HomeController@postContact')
        ->name('frontend::home.contact.post');
});

Route::group(['prefix'=>'factory'],function(Router $router){
    $router->get('/','FactoryController@index')
        ->name('frontend::factory.index.get');
    $router->get('{sluf}','FactoryController@detail')
        ->name('frontend::factory.detail.get');
});

//cart
Route::group(['prefix'=>'cart'],function(Router $router){
    $router->get('/','OrderController@index')->name('frontend::cart.index.get');
    $router->get('/index','OrderController@singleAddtocart')->name('frontend::cart.single.get');
    $router->get('add','OrderController@addToCart')->name('frontend::cart.add.get');
    $router->get('remove','OrderController@removeCartItem')->name('frontend::cart.remove.get');
    $router->get('update','OrderController@updateCart')->name('frontend::cart.update.get');
    $router->get('update-qty','OrderController@updateQty')->name('frontend::cart.update-qty.get');
    $router->get('checkout','OrderController@doCheckout')->name('frontend::cart.checkout.get');
    $router->post('checkout','OrderController@checkout')->name('frontend::cart.checkout.post');
    $router->get('success','OrderController@success')->name('frontend::cart.success.get');
    $router->get('success-bank','OrderController@successbank')->name('frontend::cart.success-bank.get');
});

//location
Route::get('district','OrderController@getDistrict')->name('frontend::district.get');
Route::get('template-order','OrderController@orderTemplate')->name('frontend::order-template.get');
//latest post
Route::get('latest-post','BlogController@latestPost')->name('frontend::post.latest.get');
Route::get('video','BlogController@video')->name('frontend::post.video.get');
Route::get('video/{slug}','BlogController@singlevideo')->name('frontend::post.singlevideo.get');

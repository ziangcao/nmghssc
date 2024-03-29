<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');
    $router->resource('banner', BannerController::class);
    $router->resource('navs', NavController::class);
    $router->resource('contents', ContentController::class);
    $router->resource('basics', BasicController::class);
});

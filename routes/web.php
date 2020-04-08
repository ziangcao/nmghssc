<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// 导航列表
Route::get('navs', 'NavController@index');

// 主导航列表
Route::get('navs/primary', 'NavController@primary');

// 子导航列表
Route::get('navs/second/{pid}', 'NavController@second');

// banner 
Route::get('banner', 'BannerController@index');

// 基础信息获取
Route::get('basics', 'BasicController@index');

 // 资讯展示列表
Route::get('news', 'ContentController@news');

// 单条资讯详情
Route::get('news/detail/{id}', 'ContentController@detail');

// 产品展示列表
Route::get('products/{nid}', 'ContentController@products');

// 成功案例列表
Route::get('case', 'ContentController@case');

// 成功案例列表
Route::get('list', 'ContentController@list');

// 公司介绍
Route::get('company', 'ContentController@company');


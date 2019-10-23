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

 // 内容展示列表
Route::get('content', 'ContentController@index');

// 单条内容详情
Route::get('content/detail/{id}', 'ContentController@detail');


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

//前台
Route::group(['namespace' => 'Home'],  function () {
    Route::any('wechat/index', 'WechatController@index');
    Route::any('wechat/oauth_callback', 'WechatController@oauth_callback');
    Route::any('wechat/create_prepaid', 'WechatController@create_prepaid');
    Route::any('order/wx_notify', 'OrderController@wx_notify');
    Route::any('menu/saveButton', 'IndexController@saveButton');
    Route::any('menu/getMenu', 'IndexController@getMenu');
    Route::any('menu', 'IndexController@menu');
    Route::any('/', 'IndexController@index');

});
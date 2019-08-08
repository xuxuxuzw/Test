<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['prefix' => 'index'], function () {
    Route::get('/', function () {
        dd('This is the Base module index page. Build something great!');
    });

    Route::any('/wechat/index', 'WechatControllers@index');
    Route::any('/wechat/oauth_callback', 'WechatControllers@oauth_callback');
    Route::any('/wechat/create_prepaid', 'WechatControllers@create_prepaid');
    Route::any('/order/wx_notify', 'OrderControllers@wx_notify');
    Route::any('/menu/saveButton', 'IndexControllers@saveButton');
    Route::any('/menu/getMenu', 'IndexControllers@getMenu');
    Route::any('/menu', 'IndexControllers@menu');
    Route::any('/index', 'IndexControllers@index');

});
//前台
//Route::group(['namespace' => 'Home'],  function () {
//    Route::any('wechat/index', 'WechatControllers@index');
//    Route::any('wechat/oauth_callback', 'WechatControllers@oauth_callback');
//    Route::any('wechat/create_prepaid', 'WechatControllers@create_prepaid');
//    Route::any('order/wx_notify', 'OrderControllers@wx_notify');
//    Route::any('menu/saveButton', 'IndexControllers@saveButton');
//    Route::any('menu/getMenu', 'IndexControllers@getMenu');
//    Route::any('menu', 'IndexControllers@menu');
//    Route::any('/', 'IndexControllers@index');
//});
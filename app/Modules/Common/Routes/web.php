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

Route::group(['prefix' => 'common'], function () {
    Route::get('/', function () {
        dd('This is the Common module index page. Build something great!');
    });

    //邮件发送
    Route::any('mail/send','MsgContentControllers@send');
    Route::any('msg/sendQqSms','MsgContentControllers@sendQqSms');
    Route::any('msg/sendWxMsg','MsgContentControllers@sendWxMsg');
    Route::any('msg/test','MsgContentControllers@test');
    Route::any('msg/testAddMsgWechat','MsgContentControllers@testAddMsgWechat');
    Route::any('msg/testAddQqSms','MsgContentControllers@testAddQqSms');

    //登录
    Route::any('login/login','MsgContentControllers@send');
});

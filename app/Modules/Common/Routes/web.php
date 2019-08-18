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
    Route::any('login/login','LoginControllers@login');

    //公共上传接口
    Route::post('upload/file','UploadControllers@file');//单文件上传
    Route::post('upload/files','UploadControllers@files');//单文件上传
    Route::post('upload/image','UploadControllers@image');//单图片上传
    Route::post('upload/images','UploadControllers@images');//多图片上传


});

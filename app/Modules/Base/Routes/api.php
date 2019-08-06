<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your module. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
$api = app('Dingo\Api\Routing\Router');
//这里的version是版本，里面的v1是在env里面定义好的。
$api->version('v1.0.0', function($api) {
    $api->get('test1', function(){
        return 'this is test dingo api';
    });
});

$api->version('v1.0.1', function($api) {
    $api->get('test2', function(){
        return 'this is v1.0.1 dingo api';
    });
});

Route::get('/base', function (Request $request) {
    // return $request->base();
})->middleware('auth:api');


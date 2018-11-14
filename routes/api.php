<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
////社区
//Route::group(['prefix'=>'admin/bbs','namespace'=>'Api\Bbs'],function(){
//    //帖子分类
//    Route::group(['prefix'=>'cagegory'],function (){
//        //列表
//        Route::get('index','BbsCategoryController@getIndex');
//        Route::post('add','BbsCategoryController@postAdd');
//    });
//});
$api = app('Dingo\Api\Routing\Router');
$api->group(['middleware' => 'api.auth'], function ($api) {
    $api->get('user', 'App\Http\Controllers\Api\UsersController@index');
});
$api->group(['middleware' => 'api.auth'], function ($api) {
    $api->get('user', 'App\Http\Controllers\Api\UsersController@index');
});

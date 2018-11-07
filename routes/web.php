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
// 前台路由组
Route::get('/admin/customer', [
    'uses'  => 'Admin\CustomerController@index',
    'as'    => 'customer'
]);

// 前台路由组
Route::post('/admin/customer', [
    'uses'  => 'Admin\CustomerController@index',
    'as'    => 'customer'
]);

$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    $api->group(['namespace' => 'App\Http\Controllers\Api'], function ($api) {
//namespace声明路由组的命名空间，因为上面设置了"prefix"=>"api",所以以下路由都要加一个api前缀，比如请求/api/users_list才能访问到用户列表接口
        $api->group(['middleware'=>['role:admin']], function ($api) {
            #管理员可用接口
            #用户列表api
            $api->get('/users_list','AdminApiController@usersList');
            #添加用户api
            $api->post('/add_user','AdminApiController@addUser');
            #编辑用户api
            $api->post('/edit_user','AdminApiController@editUser');
            #删除用户api
            $api->post('/del_user','AdminApiController@delUser');
            #上传头像api
            $api->post('/upload_avatar','UserApiController@uploadAvatar');

        });
        $api->get('api/index','IndexController@index');

    });
});
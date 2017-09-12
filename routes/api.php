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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//路由直接返回值
Route::get('/test',function (){
    return 'test';
});

//路由链接控制器返回值
Route::get('/example','testController@test');

//路由器的闭包写法
Route::get('test/test',function (){
    return '闭包写法';
});

//非闭包写法
Route::get('test1','testController@test');

//可用的路由方法

Route::get('test',function (){
    return 'get';
});
Route::post('test',function (){
    return 'post';
});
Route::put('test',function (){
    return 'put';
});
Route::patch('test',function (){
    return 'patch';
});
Route::delete('test',function (){
    return 'delete';
});
Route::options('test',function (){
    return 'options';
});

//选择几种方法匹配
Route::match(['get','post'],'match',function(){
    return 'match';
});

//任意请求方法
Route::any('any',function (){
    return 'any';
});
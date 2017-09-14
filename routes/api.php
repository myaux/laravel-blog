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

//路由参数

//必选路由参数
Route::get('user/{id}',function ($id){
    return "id is $id";
});

//多个必选路由参数
Route::get('student/{name}/age/{age}',function ($name,$age){
    return "$name age is $age";
});

//可选路由参数  {  ?}表示参数可选
Route::get('computer/{name?}',function ($name = null){
    return "computer name is $name";
});

//正则表达式约束
Route::get('page/{id}',function ($id){
    return "page id is $id";
})->where('id','[0-9]+');

//全局约束
//在RouteServiceProvider 中设置
Route::get('sex/{sex}',function ($sex){
    return "sex is $sex";
});

//命名路由
Route::get('home',function (){
    $url = route('home');
    return "home is $url";
})->name('home');

//访问时会进行一次跳转到home   redirect 执行跳转
Route::get('go/home',function (){
    return redirect()->route('home');
});
/*
 * 跳转到百度    可以指定跳转页面
 * Route::get('go/home',function (){
 * return redirect('http://www.baidu.com');
 * });
 */

//路由组

//路由默认访问命名空间为  App\Http\Controllers\   可写在'App\Http\Controllers\Data'
Route::group(['namespace'=>'\Date'],function (){
    Route::get('data','DataController@data');
    Route::get('show','DataController@show');
});

//路由前缀
Route::get('login',function (){
    return 'login';
})->prefix('user');
//group 写法
Route::group(['prefix'=>'user1'],function (){
    Route::post('login',function (){
        return 'login';
    });
    Route::get('register',function (){
        return 'register';
    });
    Route::group(['prefix' => 'child'],function (){
        Route::post('login',function (){
            return 'child login';
        });
        Route::get('register',function (){
            return 'chile register';
        });
    });
});



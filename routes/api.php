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

//请求与相应


//请求
Route::group(['prefix' => 'test'],function (){
    Route::get('request',function (\Illuminate\Http\Request $request){
        return json_encode($request);
    });
    //获取请求路径
    Route::get('path','testConstroller@path');
    //获取请求url
    Route::get('url','testController@url');
    //获取完整请求url
    Route::get('fullUrl','testController@fullUrl');
    //获取请求方法
    Route::get('method','testController@method');
    //获取是否为某种方法
    Route::any('isMethod','testController@isMethod');
    //获取所有请求参数
    Route::any('all','testController@all');
    //获取指定参数
    Route::get('input','testController@input');
    //根据动态属性获取值
    Route::get('name','testController@name');
    //获取部分数据
    Route::get('only','testController@only');
    //排除制定的数据
    Route::get('except','testController@except');
    //判断是否有数据
    Route::get('has','testController@has');
});

Route::group(['prefix' => 'test2'],function (){
    Route::get('path',function (Request $request){
        return $request->path();
    });
    Route::get('url',function (Request $request){
        return $request->url();
    });
    Route::get('fullUrl',function (Request $request){
        return $request->fullUrl();
    });
    Route::get('method',function (Request $request){
        return $request->method();      //返回请求的方法类型
    });
    Route::any('isMethod',function (Request $request){
        return $request->isMethod('GET')?'is get':'not is get';      //判断是否为某种方法
    });
    //request获取请求数据
    Route::any('all',function (Request $request){
        return $request->all();  //获取所有的输入参数 get，post  参数都会接受
    });
    Route::get('input',function (Request $request){
        return $request->input('name','无名'); //获取特定的值
    });
    Route::get('only',function (Request $request){
        return $request->only(['name','age']); //只返回指定参数的值  未输入默认值null
    });
    Route::get('except',function (Request $request){
        return $request->except(['name','age']);   //排除制定参数的值   类似unset作用
    });
    Route::get('has',function (Request $request){
        return $request->has('name')?'has name':'not has name';   //排除指定参数的值
    });
    //except返回排除指定参数外的其他参数
    //has返回设定的返回值


    //request 获取上传文件
    Route::post('hasFile',function (Request $request){
        $hasFile = $request->hasFile('file');
        return $hasFile?'has file':'not has file';
    });
    Route::post('file',function (Request $request){
        //文件通过PHP上传后，会储存到一个默认的文件夹中（tmp）
        //如果脚本执行结束后，文件没有被移动，那么就会被删除
        //文件在上传后，会给一个随机的名称

        //laravel request 会通过文件内容来猜测文件格式
        $file = $request->file('file');
        return $file->getFilename().'.'.$file->extension();
    });
    Route::post('store',function (Request $request){
        $file = $request->file('file');
        $path = $file->store('public/avatar');
        return $path;
    });

    Route::get('response',function (){
        //基础的返回结果
 //       return response('返回内容',201,['name' => 'tom']);

        $user = new stdClass();
        $user->name = 'tom';
        //返回json 数据
 //      return response()->json(['name' => 'tom','user' => $user],201);
        return response()->redirectTo('http://www.baidu.com');
    });
});

//数据库
Route::group(['prefix' => 'db-test'],function (){
    Route::group(['prefix' => 'nativity'],function (){
        Route::post('select',function (){
            //DB是一个 facede(门面）， 用于便捷的访问数据库操作对象
            //select 方法可以执行一个查询语句，并返回结果对象
            //select 方法，返回对象的集合

            //查询数据库内的表列表
            //$tables = DB::select('show tables');
            $result = DB::select("select from * users");

            //Log::info('tables',[$tables]);
            Log::info('tables',[$result]);

            //return $tables;
            return $result;
        });
        Route::post('insert',function (){

            //insert操作会返回操作是否成功
            //值允许执行一条语句

            $creted_at = date('Y-m-d H-i-s');
            $email = time().'@qq.com';

            // ,('bbb', '$email', 'b11111', '$creted_at')
            // todo...  同时插入两条数据email冲突无法插入
            $insert_ret = DB::insert("
            insert
            into `users` (`name`, `email`, `password`, `created_at`)
            value ('aaa', '$email', 'a11111', '$creted_at')
            ");
            return $insert_ret?'插入成功':'插入失败';
        });
        Route::post('update',function (){
            //update 错做会返回受影响的行数
            //可以进行参数绑定操作
            //未被修改的行不算做受影响的行数
            $affect1 = DB::update("update `users` set `password` = ?",['123456']);
            $affect2 = DB::update("update `users` set `name` = :name",['name'=>'new name']);
            return [
                'affect1' => $affect1,
                'affect2' => $affect2
            ];
        });
        //delete 操作返回被删除的行数
        //statements用于执行没有返回值的语句
        //auto-transaction自动事务   sql语句成功时自动提交，失败时自动回滚
        //transaction   手动事务
        //bind  参数绑定
    });
});


#轻松学会Laravel-基础篇

Laravel 一键安装包下载：[http://www.golaravel.com/download/](http://www.golaravel.com/download/)  

###路由参数
```
Route::get('user/{id}', function($id){
	return $id;
});
```
符合条件的路由：http://www.zhulinjie.com/laravel/public/user/1

```
Route::get('user/{name?}', function($name='zhangsan'){
	return $name;
});
```
不传参数访问： http://www.zhulinjie.com/laravel/public/user
传参数访问：http://www.zhulinjie.com/laravel/public/user/zhulinjie

```
Route::get('user/{name?}', function($name='zhangsan'){
	return $name;
})->where('name', '[A-Za-z]+');
```
符合条件的路由：http://www.zhulinjie.com/laravel/public/user/zhangsan
不符合条件的路由：

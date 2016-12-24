#轻松学会Laravel-基础篇

######Laravel 一键安装包下载：[http://www.golaravel.com/download/](http://www.golaravel.com/download/)

###路由参数
```
Route::get('user/{id}', function($id){
	return $id;
});
```
符合条件的路由：http://www.zhulinjie.com/laravel/public/user/1

![](image/screenshot_1482508955063.png)

```
Route::get('user/{name?}', function($name='zhangsan'){
	return $name;
});
```
不传参数访问： http://www.zhulinjie.com/laravel/public/user

![](image/screenshot_1482509018979.png)  

传参数访问：http://www.zhulinjie.com/laravel/public/user/zhulinjie

![](image/screenshot_1482509088598.png)

```
Route::get('user/{name?}', function($name='zhangsan'){
	return $name;
})->where('name', '[A-Za-z]+');
```
符合条件的路由：http://www.zhulinjie.com/laravel/public/user/zhangsan

![](image/screenshot_1482508724051.png)  

不符合条件的路由：http://www.zhulinjie.com/laravel/public/user/1
![](image/screenshot_1482508768893.png)

###别名路由
```
Route::get('user/user-personal', ['as'=>'personal', function(){
	return route('personal');
}]);
```
符合条件的路由：http://www.zhulinjie.com/laravel/public/user/zhangsan

![](image/screenshot_1482509183202.png)

###路由群组
```
Route::group(['prefix'=>'admin'], function(){
	Route::get('user/user-personal', ['as'=>'personal', function(){
		return route('personal');
	}]);
});
```
符合条件的路由：http://www.zhulinjie.com/laravel/public/admin/user/user-personal

![](image/screenshot_1482509510013.png)

###控制器
routes.php
```
Route::get('user/personal', [
	'uses' => 'PersonalController@index',
	'as' => 'personal'
]);
```
PersonalController.php
```
<?php

namespace App\Http\Controllers;

class PersonalController extends Controller
{
	public function index(){
		return route('personal');
	}
}
```
![](image/screenshot_1482511083393.png)

###模型
Personal.php
```
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model{
	public static function getAll(){
		return 'data';
	}
}
```
PersonalController.php
```
<?php

namespace App\Http\Controllers;

use App\Personal;

class PersonalController extends Controller
{
	public function index(){
		return Personal::getAll();
	}
}
```
![](image/screenshot_1482515920062.png)

###使用DB facade实现CURD
```
CREATE TABLE `student` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '学生表',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '姓名',
  `age` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '年龄',
  `sex` tinyint(3) unsigned NOT NULL DEFAULT '10' COMMENT '10 未知   20 男   30 女',
  `create_at` int(11) NOT NULL DEFAULT '0' COMMENT '新增时间',
  `update_at` int(11) NOT NULL DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
```

routes.php
```
Route::get('student', [
	'uses' => 'StudentController@index',
	'as' => 'student'
]);
```
StudentController.php
```
<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
	public function index(){
		// 新增
		// $bool = DB::insert('insert into student(name, age) values(?, ?)', ['lisi', 25]);
		// var_dump($bool);
		
		// 更新
		// $num = DB::update('update student set age = ? where name = ?', [20, 'zhangsan']);
		// 返回影响的行数
		// var_dump($num);		

		// 删除
		// $num = DB::delete('delete from student where id > ?', [1]);
		// 返回影响的行数
		// var_dump($num);
		
		// 查询
		$data = DB::select('select * from student where id >= ?', [1]);
		dd($data);
	}
}
```
![](image/screenshot_1482516058916.png)

###查询构造器新增数据
```
<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
	public function index(){
		// 新增一条数据
		// $bool = DB::table('student')->insert(['name'=>'zhangsan', 'age'=>18]);
		// var_dump($bool);
		
		// 新增一条数据并获取自增ID
		// $id = DB::table('student')->insertGetId(['name'=>'lishi', 'age'=>20]);
		// var_dump($id);
		
		// 新增多条数据
		$bool = DB::table('student')->insert([
			['name'=>'wangwu', 'age'=>25],
			['name'=>'zhaoliu', 'age'=>22]
		]);
		var_dump($bool);
	}
}
```

###查询构造器更新数据
```
<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
	public function index(){
		// 更新 返回受影响的行数
		// $num = DB::table('student')->where('id', 4)->update(['age'=>30]);
		// var_dump($num);
		
		// 自增1
		// $num = DB::table('student')->where('id', 4)->increment('age'); 
		// var_dump($num);

		// 自增3
		// $num = DB::table('student')->where('id', 4)->increment('age', 3);
		// var_dump($num);

		// 自减1
		// $num = DB::table('student')->where('id', 4)->decrement('age');
		// var_dump($num);
		
		// 自减3
		// $num = DB::table('student')->where('id', 4)->decrement('age', 3);
		// var_dump($num);

		// 自增3 同时将name改为zhulinjie
		$num = DB::table('student')->where('id', 4)->increment('age', 3, ['name'=>'zhulinjie']);
		var_dump($num);
	}
}
```


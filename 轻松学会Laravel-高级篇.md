#轻松学会Laravel-高级篇

###Composer快速入门
>Composer官网：[https://getcomposer.org/](https://getcomposer.org/)  
>Composer中文网：[http://www.phpcomposer.com](http://www.phpcomposer.com)

###通过composer.phar安装Composer
局部安装：将composer.phar文件复制到任意目录（比如项目根目录下），然后通过`php composer.phar`指令即可以使用Composer了

全局安装：
```
chmod u+x composer.phar
mv composer.phar /bin/composer
```

###Composer中国全量镜像
>http://pkg.phpcomposer.com/

查看当前的镜像地址
```
composer config -g repo.packagist
```

Packagist 镜像用法：
全局配置
```
composer config -g repo.packagist composer https://packagist.phpcomposer.com
```

单个项目配置
打开命令行窗口（windows用户）或控制台（Linux、Mac 用户），进入你的项目的根目录（也就是 composer.json 文件所在目录），执行如下命令：
```
composer config repo.packagist composer https://packagist.phpcomposer.com
```
注：如果没有composer.json文件，需要新建一个composer.json文件，还需要在里面写一对{}号，不然执行这个命令会报错

###使用Composer
```
mkdir demo
cd demo
composer init
composer config repo.packagist composer https://packagist.phpcomposer.com
```

搜索（search）
```
composer search monolog
```

展示（show）
```
composer show --all monolog/monolog
```

申明依赖（require）
vi composer.json
```
"require": {
    "monolog/monolog":"1.21.*",
    "symfony/http-foundation": "^3.2"
},
```

安装（install）
```
composer install
```

更新（update）
vi composer.json
```
"require": {
    "monolog/monolog":"1.21.*"
},
```
composer update

###使用Composer安装Laravel
通过Composer Create-Project 命令安装 Laravel
```
composer search laravel
composer show --all laravel/laravel
composer create-project laravel/laravel --prefer-dist blog
composer create-project laravel/laravel shop --prefer-dist "5.3.*"		// 安装某个具体版本
```

Laravel 安装器
```
// 使用 Composer 下载 Laravel 安装包
composer global require "laravel/installer"
// 再将 ~/.composer/vendor/bin 路径加到 PATH
echo 'export PATH="$PATH:$HOME/.composer/vendor/bin"' >> ~/.bashrc
// 测试Laravel 安装器是否安装成功
laravel
// 安装laravel
laravel new laravel2
// 下载最新的开发版本
laravel new test --dev
```

###Artisan基本用法
查看所有可用的Artisan的命令（list）
```
php artisan
php artisan list
```

查看命令的帮助信息（help）
php artisan help make:controller

```
composer create-project laravel/laravel laravel53 --prefer-dist "5.3.*"
// 创建控制器
php artisan make:controller StudentController
// 创建模型
php artisan make:model Student
// 创建中间件
php artisan make:middleware Activity
```

###Laravel中的用户认证（Auth）
```
// 生成Auth所需文件
php artisan make:auth
// 执行迁移
php artisan migrate
```
通过访问 http://192.168.99.100:8080/home 就可以进行注册登录了，如果访问出现了样式问题，只需要将 resources/views/layouts/app.blade.php 文件中引入css和引入js的路径改为如下即可：
```
{{ asset('css/app.css') }}
{{ asset('js/app.js') }}
```

###Laravel中的数据迁移
######新建迁移文件
通过 `php artisan make:migration create_students_table` 来新建迁移文件。--table和--create参数可以用来指定数据表名称，以及迁移文件是否要建立新的数据表

生成模型的同时生成迁移文件 `php artisan make:model Student -m`

下面咱们以students表来新建一个迁移文件，表结构如下
```
create table if not exists students(
	id int auto_increment primary key,
    name varchar(255) not null default '' comment '姓名',
    age int unsigned not null default 0 comment '年龄',
    sex int unsigned not null default 10 comment '性别',
    created_at int not null default 0 comment '新增时间',
    updated_at int not null default 0 comment '修改时间'
)engine=innodb default charset utf8 auto_increment=1001 comment='学生表';
```

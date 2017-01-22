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
composer show -all monolog/monolog
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
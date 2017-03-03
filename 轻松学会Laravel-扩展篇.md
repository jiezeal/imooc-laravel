#轻松学会Laravel-扩展篇

创建资源模型控制器
```
php artisan make:controller PhotoController --resource --model=Photo
```

发送 PUT，PATCH 或者 DELETE 请求，你需要添加一个 _method 隐藏域字段来伪造 HTTP 动作。method_field 辅助函数可以为你创建这个字段
```
```
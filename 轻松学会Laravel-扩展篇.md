#轻松学会Laravel-扩展篇

创建资源模型控制器
```
php artisan make:controller PhotoController --resource --model=Photo
```

发送 PUT，PATCH 或者 DELETE 请求，你需要添加一个 _method 隐藏域字段来伪造 HTTP 动作。method_field 辅助函数可以为你创建这个字段
```
{{ method_field('PUT') }}
```

任何情况下在你的应用程序中定义 HTML 表单时都应该包含 CSRF 令牌隐藏域，这样 CSRF 保护中间件才可以验证请求
```
{{ csrf_field() }}
```

资源控制器 删除
```
<a href="javascript:;" class="delete" data-id="{{ $student->id }}">删除</a>

<script>
    $(function(){
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
        });

        $('.delete').on('click', function () {
            if(confirm('确认要删除吗？')){
                $.ajax({
                    type: 'post',
                    url: '/student/' + $(this).data('id'),
                    data: {_method: 'delete'},
                    dataType: 'json',
                    success: function (data, status, xhr) {
                        if(data.ServerNo == 'SN000'){
                            alert(data.ResultData);
                            location.href = '/student';
                        }else{
                            alert(data.ResultData);
                            location.href = '/student';
                        }
                    },
                    async: true
                });
            }
        });
    });
</script>
```


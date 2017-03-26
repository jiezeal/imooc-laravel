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

###表单验证
```
// 控制器验证
$this->validate($request, [
    'Student.name' => 'required|min:2|max:20',
    'Student.age' => 'required|integer',
    'Student.sex' => 'required|integer'
], [
    'required' => ':attribute 为必填项',
    'min' => ':attribute 长度不符合要求',
    'integer' => ':attribute 必须为整数'
], [
    'Student.name' => '姓名',
    'Student.age' => '年龄',
    'Student.sex' => '性别',
]);

// Validator类验证
/*$validator = \Validator::make($request->input(), [
    'Student.name' => 'required|min:2|max:20',
    'Student.age' => 'required|integer',
    'Student.sex' => 'required|integer'
], [
    'required' => ':attribute 为必填项',
    'min' => ':attribute 长度不符合要求',
    'integer' => ':attribute 必须为整数'
], [
    'Student.name' => '姓名',
    'Student.age' => '年龄',
    'Student.sex' => '性别',
]);

if($validator->fails()){
    return redirect()->back()->withErrors($validator)->withInput();
}*/
```

```
<!-- 成功提示框 -->
@if(\Session::has('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>成功!</strong> {{ Session::get('success') }}
    </div>
@endif

<!-- 失败提示框 -->
@if(\Session::has('error'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>失败!</strong> {{ Session::get('error') }}
    </div>
@endif
```

```
<!-- 所有的错误提示 -->
@if(count($errors))
<div class="alert alert-danger">
    <ul>
        <li>{{ $errors->first() }}</li>
    </ul>
</div>

<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
```

```
{{ $errors->first('Student.name') }}
{{ $errors->first('Student.age') }}
{{ $errors->first('Student.sex') }}
```

模型中定义sex()方法
```
const SEX_UN = 10;
const SEX_BOY = 20;
const SEX_GRIL = 30;

public function sex($ind = null){
    $arr = [
        self::SEX_UN => '未知',
        self::SEX_BOY => '男',
        self::SEX_GRIL => '女'
    ];
    
    if($ind != null){
        return array_key_exists($ind, $arr) ? $arr[$ind] : $arr[self::SEX_UN];
    }
    
    return $arr;
}
```

@parent继承父模版内容
```
<!-- 尾部 -->
@section('footer')
<div class="jumbotron" style="margin:0;">
    <div class="container">
        <span>  @2016 imooc</span>
    </div>
</div>
@show
```

```
@section('footer')
	@parent
    新内容
@stop
```


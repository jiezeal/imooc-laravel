@extends('common.layouts')

@section('content')
    @include('common.message')

    <!-- 自定义内容区域 -->
    <div class="panel panel-default">
        <div class="panel-heading">学生列表</div>
        <table class="table table-striped table-hover table-responsive">
            <thead>
            <tr>
                <th>ID</th>
                <th>姓名</th>
                <th>年龄</th>
                <th>性别</th>
                <th>添加时间</th>
                <th width="120">操作</th>
            </tr>
            </thead>
            <tbody>
            @forelse($students as $student)
                <tr>
                    <th scope="row">{{ $student->id }}</th>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->age }}</td>
                    <td>{{ $student->sex($student->sex) }}</td>
                    <td>{{ date('Y-m-d', $student->created_at) }}</td>
                    <td>
                        <a href="/student/{{ $student->id }}">详情</a>
                        <a href="/student/{{ $student->id }}/edit">修改</a>
                        <a href="javascript:;" class="delete" data-id="{{ $student->id }}">删除</a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6">暂无数据</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <!-- 分页  -->
    <div>
        <div class="pull-right">
            {{ $students->render() }}
        </div>
    </div>
@stop

@section('script')
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
@stop


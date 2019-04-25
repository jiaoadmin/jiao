<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>根据标签群发消息</title>
    <script src="{{url('js/jquery-3.1.1.min.js')}}"></script>
</head>
<body>
{{--<form action="{{url('admin/tags')}}" method="post">--}}
    @foreach($data as $k=>$v)
        {{$v['name']}}<input type="radio" class="tags" value="{{$v['id']}}" name="tag"><br>
    @endforeach
    <a href="javascript:;" class="but"><input type="submit" value="选择发送"></a>

{{--</form>--}}
</body>
</html>
<script>
    $(function(){
        $(document).on('click','.but',function(){
            //获取标签id
            var tagid = $('.tags').val();
            console.log(tagid);
        })
    })
</script>
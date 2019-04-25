<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
@foreach($menu as $k=>$v)
    {{$k}}
    ，{{$v}}
    {{--@if($v['pid']==4)
        一级菜单
        {{$v->name}}
        {{$v->type}}
    @elseif($v['pid']==$v['m_id'])
        二级菜单
        {{$v->name}}
        {{$v->type}}
    @endif--}}
@endforeach
</body>
</html>
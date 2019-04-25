<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>查询标签</title>
</head>
<body>
    <table>
        <tr>
            <td>TagId</td>
            <td>标签名称</td>
        </tr>
        @foreach($data as $k=>$v)
        <tr>
            <td>{{$v}}</td>
            <td></td>
        </tr>
        @endforeach
    </table>
</body>
</html>
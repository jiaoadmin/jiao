<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>删除标签</title>
</head>
<body>
<table border="1">
    <tr>
        <td>id</td>
        <td>标签名</td>
        <td>操作</td>
    </tr>
    <?php foreach ($data as $k=>$v){?>
    <tr>
        <td>
            <?php echo $v['id'];?>
        </td>
        <td>
            <?php echo $v['name'];?>
        </td>
        <td>
            <a href="{{url('admin/labeldel/'.$v['id'])}}">删除</a>
        </td>
    </tr>
    <?php }?>
</table>
</body>
</html>
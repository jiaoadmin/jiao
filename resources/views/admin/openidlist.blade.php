<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="{{url('js/jquery-3.1.1.min.js')}}"></script>
</head>

<body>
<form action="" method="post">
    <select name="label" id="label">
        <?php foreach ($data as $k=>$v){;?>
        <option value="<?php echo $v['id'];?>"><?php echo $v['name'];?></option>
        <?php };?>
    </select>
            <table border="1">
                <tr>
                    <td>头像</td>
                    <td>姓名</td>
                    <td>openid</td>
                    <td>地区</td>
                    <td>性别</td>
                    <td></td>
                </tr>
                <?php foreach ($user_arr as $k=>$v){;?>
                <tr>
                    <td><img src="<?php echo $v['headimgurl'];?>" alt=""></td>
                    <td><?php echo $v['nickname'];?></td>
                    <td><?php echo $v['openid'];?></td>
                    <td><?php echo $v['city'];?></td>
                    <td><?php echo $v['sex'];?></td>
                    <td>
                        <input type="checkbox" name="radio" value="<?php echo $v['openid'];?>" id="radio">
                    </td>
                </tr>
                <?php };?>
            </table>
            <input type="button" value="添加标签" id="btn">
</form>
</body>
</html>
    <script>
        $(function () {
            $("#btn").click(function () {

                //获取用户openid
                var obj = document.getElementsByName("radio");
                //console.log(obj);
                check_val = [];
                for(k in obj) {
                    if(obj[k].checked)
                        check_val.push(obj[k].value);
                }

                //获取标签id
                var label = $("#label").val();
                //console.log(label);

                //post传值
                $.ajax({
                    url:"{{url('admin/openidlabel')}}",
                    type:"post",
                    dataType:"json",
                    data:{openid:check_val,label:label},
                    success:function (msg) {
                        //console.log(msg);
                        if(msg==1){
                            alert('添加标签成功');
                        }else{
                            alert('添加标签失败');
                        }
                    }
                })

            })

        })
    </script>
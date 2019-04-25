<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="{{url('layui/css/layui.css')}}">
    <script src="{{url('js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{url('layui/layui.js')}}"></script>
</head>
<body>
<div class="wrapper">
    <input name="hidForward" type="hidden" id="hidForward" />
    <div class="registerCon">
        <ul>
            <li class="accAndPwd">
                <dl>
                    <s class="phone"></s><input id="userMobile" maxlength="11" type="number" placeholder="请输入您的手机号码" value="" />
                </dl>
            </li>
            <li>
                <input type="text" id="Mobile" placeholder="请输入验证码" value=""/>
                <a href="javascript:void(0);" class="sendcode" id="btn">获取验证码</a>
            </li>
            <li><a id="btnNext" href="javascript:;" class="orangeBtn loginBtn">绑定</a></li>
        </ul>
    </div>
    <a><font font-size="10px">没有账号 快去注册</font></a>
</div>
</body>
</html>
<script>
    $(function(){
        layui.use('layer',function(){
            var layer=layui.layer;
            $('#btnNext').click(function(){
                var tel=$('#userMobile').val();
                var code=$('#Mobile').val();
                var reg=/^1(3[0-9]|4[57]|5[0-35-9]|8[0-9]|7[06-8])\d{8}$/;//验证手机正则(输入前7位至11位)
                if($('#userMobile').val()==''){
                    layer.msg('请输入您的手机号！');
                    return false;
                }else if(!reg.test(tel)){
                    layer.msg('手机号格式不对！');
                    return false;
                }else if(code==''){
                    layer.msg('验证码不能为空');
                    return false;
                }
                $.post(
                    "{{url('admin/useraccredit')}}",
                    {code:code,tel:tel},
                    function (res) {
                        {{--if(res==1){--}}
                        {{--layer.msg('验证码不正确 请确认后输入');--}}
                        {{--}else{--}}
                        {{--location.href="{{url('index')}}";--}}
                        {{--// console.log(res);--}}
                        {{--}--}}
                        console.log(res);
                    }
                )
            })
       /*     //点击获取验证码
            $("#btn").click(function () {
                var tel=$('#userMobile').val();
                var reg=/^1(3[0-9]|4[57]|5[0-35-9]|8[0-9]|7[06-8])\d{8}$/;//验证手机正则(输入前7位至11位)
                if($('#userMobile').val()==''){
                    layer.msg('请输入您的手机号！');
                    return false;
                }else if(!reg.test(tel)) {
                    layer.msg('手机号格式不对！');
                    return false;
                }else{
                    layer.msg('已发送 稍等片刻呢');
                }
                /!*$.post(
                    "setcode",
                    {tel:tel},
                    function (res) {
                        console.log(res);
                    }
                )*!/
            })*/



        })

    })
</script>

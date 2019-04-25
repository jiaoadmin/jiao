<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>关注处理</title>
</head>
<body>
    <form action="/admin/udo" method="post" enctype="multipart/form-data">
        @csrf
        <div class="select">
            <span>请选择回复的类型</span>
            <select name="type" id="type">
                <option value="text">文本</option>
                <option value="video">视频</option>
                <option value="audio">语音</option>
                <option value="music">音乐</option>
                <option value="img">图片</option>
                <option value="news">图文</option>
            </select>
        </div>

        <div id="text">
            <textarea name="content" id="content" cols="30" rows="10"></textarea>
        </div>

        <div class="news" style="display: none;">
            设置标题：<input type="text" name="title">
            设置简介：<input type="text" name="des">
            选择图片：<input type="file" name="material">
            跳转地址：<input type="text" name="url">
        </div>

        <div class="video audio music img" style="display: none;">
            选择文件：<input type="file" name="material">
        </div>

        <div id="sub" style="display: block">
            <input type="submit" value="提交">
        </div>
    </form>
</body>
</html>
<script src="{{url('js/jquery-1.8.3.min.js')}}"></script>
<script>
    $(function(){
        $('#type').change(function(){
            var type = $(this).val();
            if(type == 'news'){
                $('.news').show();
                $('.news').siblings().hide();
                $('.select').show();
                $('#sub').show();
            }else if(type == 'text'){
                $('#text').show();
                $('#text').siblings().hide();
                $('.select').show();
                $('#sub').show();
            }else{
                $('.news').hide();
                $('#text').hide();
                $('.img').show();
                $('#sub').show();
            }
        })
    })
</script>
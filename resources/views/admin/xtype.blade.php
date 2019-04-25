<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="{{url('layui/layui.js')}}"></script>
    <script src="{{url('layui/css/layui.css')}}"></script>
    <script src="{{url('js/jquery-1.11.2.min.js')}}"></script>
    <title>Document</title>
</head>
<body>
<form  action="#" method="">
    <div class="weui-cells weui-cells_radio">
        <label class="weui-cell weui-check__label" for="x11">
            <div class="weui-cell__bd">
                <p>图片<span class="con"></span></p>
            </div>
            <div class="weui-cell__ft">
                <input type="radio" class="weui-check" value="image" id="x11"/>
                <span class="weui-icon-checked"></span>
            </div>
        </label>
        <label class="weui-cell weui-check__label" for="x12">
            <div class="weui-cell__bd">
                <p>文字<span class="con"></span></p>
            </div>
            <div class="weui-cell__ft">
                <input type="radio" class="weui-check" value="text" id="x12" />
                <span class="weui-icon-checked"></span>
            </div>
        </label>
        <label class="weui-cell weui-check__label" for="x13">
            <div class="weui-cell__bd">
                <p>视频<span class="con"></span></p>
            </div>
            <div class="weui-cell__ft">
                <input type="radio" class="weui-check" value="video" id="x13"/>
                <span class="weui-icon-checked"></span>
            </div>
        </label>
        <label class="weui-cell weui-check__label" for="x14">
            <div class="weui-cell__bd">
                <p>图文<span class="con"></span></p>
            </div>
            <div class="weui-cell__ft">
                <input type="radio" class="weui-check" value="news" id="x14" />
                <span class="weui-icon-checked"></span>
            </div>
        </label>
        <label class="weui-cell weui-check__label" for="x15">
            <div class="weui-cell__bd">
                <p>音乐<span class="con"></span></p>
            </div>
            <div class="weui-cell__ft">
                <input type="radio" class="weui-check" value="music" id="x15"/>
                <span class="weui-icon-checked"></span>
            </div>
        </label>
        <label class="weui-cell weui-check__label" for="x16">
            <div class="weui-cell__bd">
                <p>语音<span class="con"></span></p>
            </div>
            <div class="weui-cell__ft">
                <input type="radio" class="weui-check" value="voice" id="x16"/>
                <span class="weui-icon-checked"></span>
            </div>
        </label>
    </div>
    <button class="weui-btn weui-btn_primary" id="btn">确定修改</button>

</div>
</form>


<script>
    $(document).ready(function(){
        $("input[type='radio']").each(function(){
            var type= $(this).val();
            var data='{{$type}}';
            // console.log(data);
            if(type==data){
                $(this).attr('checked','checked')
            }
        })
    });

    $(document).on("click",".weui-check",function(){
        $("input[type='radio']").prop("checked",false);
        $(this).prop("checked",true);
    });

    $('#btn').click(function(){
        var type=$("input[type='radio']:checked").val();
        var result=confirm("您选择的是"+type+"类型是否确认");
        if(result){
            $.post(
                "{{url('admin/typedo')}}",
                {type:type,_token:'{{csrf_token()}}'},
                function(res){
                    console.log(res);
                }
            )
        }else{
            history.go(0);
        }

    })
</script>
</body>
</html>

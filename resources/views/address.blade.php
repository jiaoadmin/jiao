<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>地址管理</title>
    <meta content="app-id=984819816" name="apple-itunes-app" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link href="{{url('css/comm.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{url('css/address.css')}}">
    <link rel="stylesheet" href="{{url('css/sm.css')}}">
    <script src="{{url('layui/layui.js')}}"></script>
    <script src="{{url('layui/css/layui.css')}}"></script>
   
    
</head>
<body>
    
<!--触屏版内页头部-->
<div class="m-block-header" id="div-header">
    <strong id="m-title">地址管理</strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="{{url('address/useradd')}}" class="m-index-icon">添加</a>
</div>
<div class="addr-wrapp">
    <div class="addr-list">
         <ul>
            @foreach($data as $v)
            <li class="clearfix">
                <span class="fl">{{$v->address_name}}</span>
                <span class="fr">{{$v->tel}}</span>
            </li>
            <li>
                <p>{{$v->consignee}}</p>
            </li>
            <li class="a-set">
                @if($v->is_default==1)
                <s class="z-set" style="margin-top: 6px;"></s>
                <span class="is_default" address_id="{{$v->address_id}}">默认收货地址</span>
                @elseif($v->is_default==2)
                <span class="is_default" address_id="{{$v->address_id}}">设为默认</span>
                @endif
                <div class="fr">
                    <span class="edit"  address_id="{{$v->address_id}}"><a href="{{url('address/edit/'.$v->address_id)}}">编辑</a></span>
                    <span class="remove"  address_id="{{$v->address_id}}">删除</span>
                </div>
            </li>
            @endforeach
        </ul>  
    </div>
   
</div>


<script src="{{url('js/zepto.js')}}" charset="utf-8"></script>
<script src="{{url('js/sm.js')}}"></script>
<script src="{{url('js/sm-extend.js')}}"></script>


<!-- 单选 -->
<script>
    $(function(){
        layui.use('layer',function(){

            //点击删除
            $(document).on('click','span.remove',function(){
                var _this = $(this);
                var address_id = _this.attr('address_id');
                //向控制器传值
                $.ajax({
                    type:"post",
                    url:"{{url('address/del')}}",
                    data:{address_id:address_id,_token:'{{csrf_token()}}'},
                    success:function(res){
                        // console.log(res);
                        if(res==1){
                            layer.msg('删除成功');
                            histroy.go(0);
                        }else if(res==2){
                            layer.msg('删除失败');
                        }
                    }
                })

            })

            /* 点击编辑
            $(document).on('click','.edit',function(){
                var _this = $(this);
                var address_id = _this.attr('address_id');
                // console.log(address_id);
                $.ajax({
                    type:"post",
                    url:"{{url('address/edit')}}",
                    data:{address_id:address_id,_token:'{{csrf_token()}}'},
                    success:function(res){
                        // location.href="{{url('address/edit')}}";
                        console.log(res);
                    }
                })

            }) */

            //点击设置为默认
            $(document).on('click','.is_default',function(){
                //获取当前id
                var _this = $(this);
                var address_id = _this.attr('address_id');
                // console.log(address_id);
                $.ajax({
                    type:"post",
                    url:"{{url('address/default')}}",
                    data:{_token:'{{csrf_token()}}',address_id:address_id},
                    success:function(res){
                        // console.log(res);
                        if(res==1){
                            layer.msg('设定成功');
                            history.go(0);
                        }else if(res==2){
                            layer.msg('设定失败');
                        }
                    }
                })

            })

        })
    })
</script>

<script src="{{url('js/jquery-1.8.3.min.js')}}"></script>

<script>
    var $$=jQuery.noConflict();
    $$(document).ready(function(){
        // jquery相关代码
        $$('.addr-list .a-set s').toggle(
            function(){
                if($$(this).hasClass('z-set')){
                    
                }else{
                    $$(this).removeClass('z-defalt').addClass('z-set');
                    $$(this).parents('.addr-list').siblings('.addr-list').find('s').removeClass('z-set').addClass('z-defalt');
                }   
            },
            function(){
                if($$(this).hasClass('z-defalt')){
                    $$(this).removeClass('z-defalt').addClass('z-set');
                    $$(this).parents('.addr-list').siblings('.addr-list').find('s').removeClass('z-set').addClass('z-defalt');
                }
                
            }
        )    
    });
</script>

</body>
</html>

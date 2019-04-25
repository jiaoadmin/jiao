<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>结算支付</title>
    <meta content="app-id=984819816" name="apple-itunes-app" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link href="{{url('css/comm.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{url('css/cartlist.css')}}">
    <link rel="stylesheet" href="{{url('layui/css/layui.css')}}">
    <script src="{{url('layui/layui.js')}}"></script>
</head>
<body>
    
<!--触屏版内页头部-->
<div class="m-block-header" id="div-header">
    <strong id="m-title">结算支付</strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="{{url('/')}}" class="m-index-icon"><i class="m-public-icon"></i></a>
</div>
<div>
    <div class="g-pay-lst">
        <ul>
            @foreach($data as $k=>$v)
            <li class='ni' goods_price="{{$v->goods_price}}" buy_number="{{$v->buy_number}}">
                <a href="">
                    <input type="hidden" name="goods_id" id="goods_id" value="{{$v->goods_id}}">
                    <span>
                        <img src="../uploads/{{$v->goods_img}}" border="0" alt="">
                    </span>
                    <dl>
                        <dt>
                            {{$v->goods_name}}
                        </dt>
                        <dd><em class="price">1</em>人次/<em>￥{{$v->goods_price}}</em></dd>
                    </dl>
                </a>
            </li>
            @endforeach
        </ul>
        <div id="divMore">
            
        </div>
        <p class="gray9">总需支付金额：<em class="orange money"><i>￥</i>{{$allprice}}</em></p>
    </div>

    <div class="other_pay marginB">
        
        <a href="javascript:;" class="method chaomoney">
            <i></i>潮购值抵扣：<span class="gray9">(可用潮购值<em>100</em>)</span><em class="orange fr"></em>
        </a>
        <a href="javascript:;" class="method leftmoney">
            <i></i>账户总额：<span class="gray9">(￥<em>0.00</em>)</span><em class="orange fr"></em>
        </a>
        <a href="javascript:;" class="wzf checked">
            <b class="z-set"></b>第三方支付
            <em class="orange fr">
                <span class="colorbbb">需要支付&nbsp;</span><b>￥</b>{{$allprice}}
                <input type="hidden" id="hid" name="allprice" value="{{$allprice}}">
            </em>
        </a>
        <div class="net-pay">
            <a href="javascript:;" class="checked" id="jdPay">
                <span class="zfb"></span><!-- 支付宝支付 -->
                <b class="z-set" id="zfb" type="1"></b>
            </a><!-- 
            <a href="javascript:;" id="jdPay">
                <span class="kq"></span> 快钱支付 
                <b class="z-set" id="kq" type="2"></b>
            </a> -->
        </div>
        <div class="paylip">我们提倡理性消费</div>
    </div>
    <div class="g-Total-bt">
        <dd><a id="btnPay" href="javascript:;" class="orangeBtn fr w_account">立即支付</a></dd>
    </div> 


    <div class="paywrapp" style="display: none">
        <span class="lip">请输入支付密码</span>    
        <span class="title">潮人购充值</span>
        <span class="money">￥<i>{{$allprice}}</i></span>
        <form action="" method="post" name="payPassword" id="form_paypsw">
            <div id="payPassword_container" class="alieditContainer clearfix" data-busy="0">
                <div class="i-block" data-error="i_error">
                    <div class="i-block six-password">
                        <input class="i-text sixDigitPassword" id="payPassword_rsainput" type="password" autocomplete="off" required="required" value="" name="payPassword_rsainput" data-role="sixDigitPassword" tabindex="" maxlength="6" minlength="6" aria-required="true">
                        <div tabindex="0" class="sixDigitPassword-box" style="width:99%;">
                            <i style="width: 16%; border-color: transparent;" class=""><b style="visibility: hidden;"></b></i>
                            <i style="width: 16%;" class=""><b style="visibility: hidden;"></b></i>
                            <i style="width: 16%;" class=""><b style="visibility: hidden;"></b></i>
                            <i style="width:16%;" class=""><b style="visibility: hidden;"></b></i>
                            <i style="width: 16%;" class=""><b style="visibility: hidden;"></b></i>
                            <i style="width: 16%;" class=""><b style="visibility: hidden;"></b></i>
                            <!-- <span style="width: 16%; left: 285px; visibility: hidden;" id="cardwrap" data-role="cardwrap"></span> -->
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="submit">
            <input type="submit" value="取消" class="button  cancel" id="cancelbtn">
            <input type="submit" value="确定" class="button" id="subbtn">
        </div>
    </div>
            

<script src="{{url('js/jquery-1.11.2.min.js')}}"></script>
<script src="{{url('js/all.js')}}"></script>
<script src="{{url('layui/layui.js')}}"></script>


<script>
	
	$(document).ready(function(){
        //获取总价
        var total = $('#hid').val();

		// 判断选择余额支付还是潮购值支付
		var chaomoney =parseInt($('.other_pay .chaomoney span.gray9 em').text())/100;
		var leftmoney =parseInt($('.other_pay .leftmoney span.gray9 em').text());

		// 潮购不可支付
		if(chaomoney<total){
			$('.chaomoney').css('background','#e2e2e2');
		}


        //支付宝支付或快钱支付
		$('.net-pay a').click(function(){
			if($(this).hasClass('checked')){
				
			}else{
				$(this).addClass('checked').siblings('a').removeClass('checked');
			}
		})

		$('.other_pay a.method').click(function(){
			if($(this).children('i').hasClass('z-set')){
				
			}else{
				$(this).children('i').addClass('z-set').parents('a').siblings('a').children('i').removeClass('z-set');
			}
		})
	})



    // 密码框
    var payPassword = $("#payPassword_container"),
    _this = payPassword.find('i'),  
    k=0,j=0,
    password = '' ,
    _cardwrap = $('#cardwrap');
    //点击隐藏的input密码框,在6个显示的密码框的第一个框显示光标
    payPassword.on('focus',"input[name='payPassword_rsainput']",function(){
    
        var _this = payPassword.find('i');
        if(payPassword.attr('data-busy') === '0'){ 
        //在第一个密码框中添加光标样式
           _this.eq(k).addClass("active");
           _cardwrap.css('visibility','visible');
           payPassword.attr('data-busy','1');
        }
    }); 

    //change时去除输入框的高亮，用户再次输入密码时需再次点击
    payPassword.on('change',"input[name='payPassword_rsainput']",function(){
        _cardwrap.css('visibility','hidden');
        _this.eq(k).removeClass("active");
        payPassword.attr('data-busy','0');
    }).on('blur',"input[name='payPassword_rsainput']",function(){
        
        _cardwrap.css('visibility','hidden');
        _this.eq(k).removeClass("active");                  
        payPassword.attr('data-busy','0');
        
    });
    
    //使用keyup事件，绑定键盘上的数字按键和backspace按键
    payPassword.on('keyup',"input[name='payPassword_rsainput']",function(e){
    
    var  e = (e) ? e : window.event;
    
    //键盘上的数字键按下才可以输入
    if(e.keyCode == 8 || (e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105)){
            k = this.value.length;//输入框里面的密码长度
            l = _this.size();//6
            
            for(;l--;){
                //输入到第几个密码框，第几个密码框就显示高亮和光标（在输入框内有2个数字密码，第三个密码框要显示高亮和光标，之前的显示黑点后面的显示空白，输入和删除都一样）
                if(l === k){
                    _this.eq(l).addClass("active");
                    _this.eq(l).find('b').css('visibility','hidden');
                    
                }else{
                    _this.eq(l).removeClass("active");
                    _this.eq(l).find('b').css('visibility', l < k ? 'visible' : 'hidden');
                }               
                if(k === 6){
                    j = 5;
                }else{
                    j = k;
                }
                $('#cardwrap').css('left',j*43+'px');
            }

        }else{
        //输入其他字符，直接清空
            var _val = this.value;
            this.value = _val.replace(/\D/g,'');
        }
    }); 

    //点击立即支付
    $('#btnPay').click(function(){
        layer.open({
            type: 1,
            title: false,
            content: $('.paywrapp')
        })
    })
        
</script>
</body>
</html>

<script>
$(function(){
    layui.use('layer',function(){
        //点击立即支付
        $('#btnPay').click(function(){
            //获取到支付方式
            var pay_type = $('#zfb').attr('type');
            // var pay = $('#jdPay');
            // console.log(pay_type);
            //获取收货地址id（登录用户的id下的默认收货地址）
            //获取商品id
            var goods_id = $('#goods_id').val();
            
        })

        //点击取消
        $('#cancelbtn').click(function(){
            $('.paywrapp').css('style','display: none');
            history.go(0);
        })

        //点击确认
        $('#subbtn').click(function(){
            //获取总价
            var allprice = $('#hid').val();
            // console.log(allprice);
            //获取密码
            var goods_id = $('#goods_id').val();
            // console.log(goods_id);
            $.ajax({
                type:"post",
                url:"{{url('order/order')}}",
                data:{_token:'{{csrf_token()}}',goods_id:goods_id,allprice:allprice},
                success:function(res){
                    console.log(res);
                }
            })

        })



    })
})
</script>
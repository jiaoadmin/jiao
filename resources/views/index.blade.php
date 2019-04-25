@extends('master')

@section('title')
	狸猫
@endsection
@section('content')

	<body fnav="1" class="g-acc-bg">
	<div class="marginB" id="loadingPicBlock">
		<!--首页头部-->
		<div class="m-block-header" style="display: none">
			<div class="search"></div>
			<a href="/" class="m-public-icon m-1yyg-icon"></a>
		</div>
		<!--首页头部 end-->

		<!-- 关注微信 -->
		<div id="div_subscribe" class="app-icon-wrapper" style="display: none;">
			<div class="app-icon">
				<a href="javascript:;" class="close-icon"><i class="set-icon"></i></a>
				<a href="javascript:;" class="info-icon">
					<i class="set-icon"></i>
					<div class="info">
						<p>点击关注666潮人购官方微信^_^</p>
					</div>
				</a>
			</div>
		</div>

		<!-- 焦点图 -->
		<div class="hotimg-wrapper">
			<div class="hotimg-top"></div>
			<section id="sliderBox" class="hotimg">
				<ul class="slides" style="width: 600%; transition-duration: 0.4s; transform: translate3d(-828px, 0px, 0px);">
					<li style="width: 414px; float: left; display: block;" class="clone">
						<a href="http://weixin.1yyg.com/v27/products/23559.do?pf=weixin">
							<img src="http://img2.imgtn.bdimg.com/it/u=200331106,541938370&fm=26&gp=0.jpg" alt="">
						</a>
					</li>
					<li class="" style="width: 414px; float: left; display: block;">
						<a href="http://weixin.1yyg.com/v40/GoodsSearch.do?q=%E5%B0%8F%E7%B1%B36&amp;pf=weixin">
							<img src="https://img.1yyg.net/Poster/20170609151005929.jpg" alt="">
						</a>
					</li>
					<li style="width: 414px; float: left; display: block;" class="flex-active-slide">
						<a href="http://weixin.1yyg.com/v40/GoodsSearch.do?q=%E6%B8%85%E5%87%89%E4%B8%80%E5%A4%8F&amp;pf=weixin"><img src="https://img.1yyg.net/Poster/20170605084728556.jpg" alt="">
						</a>
					</li>
					<li style="width: 414px; float: left; display: block;" class="">
						<a href="http://weixin.1yyg.com/v40/GoodsSearch.do?q=%E6%96%B0%E9%B2%9C%E6%B0%B4%E6%9E%9C&amp;pf=weixin"><img src="https://img.1yyg.net/Poster/20170518163741543.jpg" alt=""></a>
					</li>
					<li style="width: 414px; float: left; display: block;" class="">
						<a href="http://weixin.1yyg.com/v27/products/23559.do?pf=weixin">
							<img src="https://img.1yyg.net/Poster/20170227170302909.png" alt="">
						</a>
					</li>
					<li class="clone" style="width: 414px; float: left; display: block;">
						<a href="http://weixin.1yyg.com/v40/GoodsSearch.do?q=%E5%B0%8F%E7%B1%B36&amp;pf=weixin">
							<img src="https://img.1yyg.net/Poster/20170609151005929.jpg" alt="">
						</a>
					</li>
				</ul>
			</section>
		</div>
		<!--分类-->
		<div class="index-menu thin-bor-top thin-bor-bottom">
			<ul class="menu-list">
				<li>
					<a href="javascript:;" id="btnNew">
						<i class="xinpin"></i>
						<span class="title">新品</span>
					</a>
				</li>
				<li>
					<a href="javascript:;" id="btnRecharge">
						<i class="chongzhi"></i>
						<span class="title">充值</span>
					</a>
				</li>
				<li>
					<a href="javascript:;" id="btnLimitbuy">
						<i class="contact"></i>
						<span class="title">联系我们</span>
					</a>
				</li>
				<li>
					<a href="javascript:;" id="btnDownApp">
						<i class="xiazai"></i>
						<span class="title">下载APP</span>
					</a>
				</li>
				<li>
					<a href="javascript:;" id="btnAllGoods">
						<i class="fenlei"></i>
						<span class="title">晒单</span>
					</a>
				</li>
			</ul>
		</div>
		<!--导航-->
		<div class="success-tip">
			<div class="left-icon"></div>
			<ul class="right-con">
				{{--<li>
					<span style="color: #4E555E;">
						<a href="./index.php?i=107&amp;c=entry&amp;id=10&amp;do=notice&amp;m=weliam_indiana" style="color: #4E555E;">恭喜<span class="username">啊啊啊</span>获得了<span>iphone7 红色 128G 闪耀你的眼</span></a>
					</span>
				</li>--}}
				{{--<li>
					<span style="color: #4E555E;">
						<a href="./index.php?i=107&amp;c=entry&amp;id=10&amp;do=notice&amp;m=weliam_indiana" style="color: #4E555E;">恭喜<span class="username">啊啊啊</span>获得了<span>iphone7 红色 128G 闪耀你的眼</span></a>
					</span>
				</li>
				<li>
					<span style="color: #4E555E;">
						<a href="./index.php?i=107&amp;c=entry&amp;id=10&amp;do=notice&amp;m=weliam_indiana" style="color: #4E555E;">恭喜<span class="username">啊啊啊</span>获得了<span>iphone7 红色 128G 闪耀你的眼</span></a>
					</span>
				</li>--}}
				<li>
					<span style="color: #4E555E;">
						<a href="index/imgs" style="color: #4E555E;">
							<span  class="username">微信公众号上线了快点去关注</span>
						</a>
					</span>
				</li>
			</ul>
		</div>
		<!-- 倒計時 -->
		<div class="endtime">

		</div>
		<!-- 热门推荐 -->
		<div class="line hot">
			<div class="hot-content">
				<i></i>
				<span>潮人推荐</span>
				<div class="l-left"></div>
				<div class="l-right"></div>
			</div>
		</div>
		<div class="hot-wrapper">
			<ul class="clearfix">
				<li style="border-right:1px solid #e4e4e4; ">
					<a href="">
						<p class="title">洋河 蓝色经典 海之蓝42度</p>
						<p class="subtitle">洋河的，棉柔的，口感绵柔浓香型</p>
						<img src="images/goods2.jpg" alt="">
					</a>
				</li>
				<li>
					<a href="">
						<p class="title">洋河 蓝色经典 海之蓝42度</p>
						<p class="subtitle">洋河的，棉柔的，口感绵柔浓香型</p>
						<img src="images/goods2.jpg" alt="">
					</a>
				</li>
			</ul>
		</div>
		<!-- 猜你喜欢 -->
		<div class="line guess">
			<div class="hot-content">
				<i></i>
				<span>猜你喜欢</span>
				<div class="l-left"></div>
				<div class="l-right"></div>
			</div>
		</div>
		<!--商品列表-->
		<div class="goods-wrap marginB">
			<ul id="ulGoodsList" class="goods-list clearfix">
				@foreach($data as $v)
				<li id="23558" codeid="12751965" goodsid="23558" codeperiod="28436">
					<a href="{{url('index/shopcontent/'.$v->goods_id)}}" class="g-pic">
						<img class="lazy" src="../uploads/{{$v->goods_img}}" name="goodsImg" data-original="" width="136" height="136">
					</a>
					<p class="g-name">{{$v->goods_name}}</p>
					<ins class="gray9">{{$v->goods_price}}</ins>
					<div class="Progress-bar">
						<p class="u-progress">
            				<span class="pgbar" style="width: 96.43076923076923%;">
            					<span class="pging"></span>
            				</span>
						</p>
					</div>
					<div class="btn-wrap" name="buyBox" limitbuy="0" surplus="58" totalnum="1625" alreadybuy="1567">
						<a href="javascript:;" class="buy-btn" codeid="12751965">立即潮购</a>
						<div class="gRate" codeid="12751965" canbuy="58">
							<a href="javascript:;"></a>
						</div>
					</div>
				</li>
				@endforeach

			</ul>
			<div class="loading clearfix"><b></b>加载更多</div>
		</div>
		<!--底部-->
		<div class="footer clearfix">
			<ul>
				<li class="f_home"><a href="/v41/index.do" class="hover"><i></i>潮购</a></li>
				<li class="f_announced"><a href="{{url('index/Allshops')}}" ><i></i>所有商品</a></li>

				<li class="f_car"><a id="btnCart" href="{{url('index/Shopcart')}}"><i></i>购物车</a></li>
				<li class="f_personal"><a href="{{url('index/Userpage')}}" ><i></i>我的潮购</a></li>
			</ul>
		</div>
		<div id="div_fastnav" class="fast-nav-wrapper">
			<ul class="fast-nav">
				<li id="li_menu" isshow="0">
					<a href="javascript:;"><i class="nav-menu"></i></a>
				</li>
				<li id="li_top" style="display: none;">
					<a href="javascript:;"><i class="nav-top"></i></a>
				</li>
			</ul>
			<div class="sub-nav four" style="display: none;">
				<a href="#"><i class="announced"></i>最新揭晓</a>
				<a href="#"><i class="single"></i>晒单</a>
				<a href="#"><i class="personal"></i>我的潮购</a>
				<a href="#"><i class="shopcar"></i>购物车</a>
			</div>
		</div>
	@endsection
		<script src="http://res2.wx.qq.com/open/js/jweixin-1.4.0.js"></script>
		<script src="{{url('js/jquery-1.8.3.min.js')}}"></script>
		<script src="http://cdn.bootcss.com/flexslider/2.6.2/jquery.flexslider.min.js"></script>
		<script src="{{url('js/jquery-1.11.2.min.js')}}"></script>
		<script src="{{url('layui/layui.js')}}"></script>
		<script src="{{url('js/all.js')}}"></script>
		<script src="{{url('js/index.js')}}"></script>
		<script src="{{url('js/lazyload.min.js')}}"></script>
	@section('my_js')
			<script>
				$(function () {
					$('.hotimg').flexslider({
						directionNav: false,   //是否显示左右控制按钮
						controlNav: true,   //是否显示底部切换按钮
						pauseOnAction: false,  //手动切换后是否继续自动轮播,继续(false),停止(true),默认true
						animation: 'slide',   //淡入淡出(fade)或滑动(slide),默认fade
						slideshowSpeed: 3000,  //自动轮播间隔时间(毫秒),默认5000ms
						animationSpeed: 150,   //轮播效果切换时间,默认600ms
						direction: 'horizontal',  //设置滑动方向:左右horizontal或者上下vertical,需设置animation: "slide",默认horizontal
						randomize: false,   //是否随机幻切换
						animationLoop: true   //是否循环滚动
					});
					setTimeout($('.flexslider img').fadeIn());
				});
			</script>
			<script>
				jQuery(document).ready(function() {
					$("img.lazy").lazyload({
						placeholder : "images/loading2.gif",
						effect: "fadeIn",
					});

					// 返回顶部点击事件
					$('#div_fastnav #li_menu').click(
							function(){
								if($('.sub-nav').css('display')=='none'){
									$('.sub-nav').css('display','block');
								}else{
									$('.sub-nav').css('display','none');
								}
							}
					)
					$("#li_top").click(function(){
						$('html,body').animate({scrollTop:0},300);
						return false;
					});

					$(window).scroll(function(){
						if($(window).scrollTop()>200){
							$('#li_top').css('display','block');
						}else{
							$('#li_top').css('display','none');
						}
					})

				});
			</script>
			<script>
                wx.config({
                    debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
                    appId: "{{$arr['appId']}}", // 必填，公众号的唯一标识
                    timestamp: "{{$arr['timestamp']}}", // 必填，生成签名的时间戳
                    nonceStr: "{{$arr['nonceStr']}}", // 必填，生成签名的随机串
                    signature: "{{$arr['signature']}}",// 必填，签名
                    jsApiList: [
						'onMenuShareTimeline',//分享到微信朋友圈
						'onMenuShareAppMessage',//分享到微信好友
						'onMenuShareQQ',//分享到QQ
						'onMenuShareQZone',//分享到QQ空间
						'openLocation',//获取地理位置
                        'getLocation'//获取地理位置
                    ]
                });
                wx.ready(function() {
                    wx.onMenuShareTimeline({//分享到朋友圈
                        title: "欢迎来到凉栀小店", // 分享标题document.title
                        link: document.URL, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                        imgUrl: 'http://mmbiz.qpic.cn/mmbiz_gif/8B4ghUJC6K9obRelSsWaLVxe6cS8ibQplwWFEESSSEGUrl5OjyjOjmQIBAUMUaaXmViboNjoD1hp0Bjh7OXJKZDA/0?wx_fmt=gif', // 分享图标
                        success: function () {
                            // 用户点击了分享后执行的回调函数
                        },
                    });
                    wx.onMenuShareAppMessage({//分享到微信好友
                        title: '欢迎来到凉栀小店', // 分享标题
                        desc: '这是一家有品位的小吃店', // 分享描述
                        link: document.URL, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                        imgUrl: 'http://mmbiz.qpic.cn/mmbiz_gif/8B4ghUJC6K9obRelSsWaLVxe6cS8ibQplwWFEESSSEGUrl5OjyjOjmQIBAUMUaaXmViboNjoD1hp0Bjh7OXJKZDA/0?wx_fmt=gif', // 分享图标
                        type: 'link', // 分享类型,music、video或link，不填默认为link
                        dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
                        success: function () {
							// 用户点击了分享后执行的回调函数
                        }
                    });
                    wx.onMenuShareQQ({//分享到QQ
                        title: '微信.凉栀的小店', // 分享标题
                        desc: '凉栀的小吃店', // 分享描述
                        link: document.URL, // 分享链接
                        imgUrl: 'http://mmbiz.qpic.cn/mmbiz_gif/8B4ghUJC6K9obRelSsWaLVxe6cS8ibQplwWFEESSSEGUrl5OjyjOjmQIBAUMUaaXmViboNjoD1hp0Bjh7OXJKZDA/0?wx_fmt=gif', // 分享图标
                        success: function () {
							// 用户确认分享后执行的回调函数
                        },
                        cancel: function () {
							// 用户取消分享后执行的回调函数
                        }
                    });
                    wx.onMenuShareQZone({//分享到QQ空间
                        title: '微信.凉栀的小店', // 分享标题
                        desc: '凉栀的小吃店', // 分享描述
                        link: document.URL, // 分享链接
                        imgUrl: 'http://mmbiz.qpic.cn/mmbiz_gif/8B4ghUJC6K9obRelSsWaLVxe6cS8ibQplwWFEESSSEGUrl5OjyjOjmQIBAUMUaaXmViboNjoD1hp0Bjh7OXJKZDA/0?wx_fmt=gif', // 分享图标
                        success: function () {
							// 用户确认分享后执行的回调函数
                        },
                        cancel: function () {
							// 用户取消分享后执行的回调函数
                        }
                    });
                    wx.getLocation({
                        type: 'wgs84', //位置 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
                        success: function (res) {
                            wx.openLocation({
                                latitude: res.latitude, // 纬度，浮点数，范围为90 ~ -90
                                longitude: res.longitude, // 经度，浮点数，范围为180 ~ -180。
                                name: '', // 位置名
                                address: '', // 地址详情说明
                                scale: 1, // 地图缩放级别,整形值,范围从1~28。默认为最大
                                infoUrl: '' // 在查看位置界面底部显示的超链接,可点击跳转
                            });
                        }
                    });



                });
			</script>
	@endsection()
</body>


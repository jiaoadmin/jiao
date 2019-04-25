<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::any('/','IndexController@Index'); //首页

Route::prefix('index')->group(function() {
    Route::any('Allshops', 'IndexController@Allshops'); //全部商品
    Route::any('imgs', 'IndexController@imgs'); //全部商品
    Route::any('category', 'IndexController@category'); //分类
    Route::get('Shopcart', 'CartController@Shopcart')->middleware('logs'); //购物车
    Route::get('Userpage', 'IndexController@Userpage'); //个人中心  第三方登录
    Route::get('token', 'IndexController@token'); //code获取token
    Route::get('Willshare', 'IndexController@Willshare'); //晒单
    Route::get('shopcontent/{id}', 'IndexController@shopcontent'); //商品详情页
});

Route::prefix('login')->group(function() {
    Route::any('login', 'LoginController@login'); //登录
    Route::post('logindo', 'LoginController@logindo'); //登录验证
    Route::any('register', 'LoginController@register'); //注册
    Route::post('registerdo', 'LoginController@registerdo'); //注册验证
    Route::any('updpwd', 'LoginController@updpwd'); //忘记密码
    Route::post('code','LoginController@code'); //注册验证码
});
Route::any('verify/create','CaptchaController@create'); //生成验证码的路由

Route::prefix('cart')->group(function() {
    Route::post('cart', 'CartController@cart'); //加入购物车
    Route::post('del', 'CartController@del');  //删除
    Route::post('dels', 'CartController@dels');  //删除
    Route::post('checknum', 'CartController@checknum'); //购买数量
    Route::post('payment', 'CartController@payment'); //支付方式
    Route::any('paymentshow', 'CartController@paymentshow'); //支付方式
});

Route::prefix('address')->group(function() {
    Route::any('address', 'AddressController@address'); //收货地址
    Route::any('buyrecord', 'AddressController@buyrecord'); //潮购记录
    Route::post('del', 'AddressController@del'); //点击删除
    Route::get('edit/{id}', 'AddressController@edituser'); //点击编辑
    Route::any('default', 'AddressController@default'); //点击设置默认
    Route::any('useradd', 'AddressController@useradd'); //点击添加
    Route::any('mywallet', 'AddressController@mywallet'); //我的钱包
});

Route::prefix('alipay')->group(function() {
    Route::get('mobilpay', 'AliPayController@mobilpay'); //手机支付
    Route::any('return', 'AliPayController@re'); //同步回调
    Route::any('notify', 'AliPayController@notify'); //异步回调
});

Route::post('order/order','OrderController@order');



Route::any('check','WecharController@valid');//调用微信回复
Route::get('check/check','MaterialController@upload_media');//调用access_token
//临时素材
Route::get('material/index','MaterialController@index');//上传临时素材
Route::post('material/upd','MaterialController@material');//上传临时素材执行

//后台
Route::prefix('admin')->group(function(){
    Route::get('welocome','Admin\\WechatAdminController@welocome'); //我的桌面
    Route::get('index','Admin\\WechatAdminController@index'); //后台首页
    Route::post('udo','Admin\\WechatAdminController@upl'); //永久素材上传入库
    Route::get('material','Admin\\WechatAdminController@material'); //永久素材上传
    Route::get('wxtype','Admin\\WechatAdminController@wxtype'); //关注回复类型
    Route::any('typedo','Admin\\WechatAdminController@typedo');
    Route::any('menu','Admin\\MenuAdminController@menu'); //创建菜单
    Route::any('tag','Admin\\MenuAdminController@tag'); //创建标签
    Route::any('tagdo','Admin\\MenuAdminController@tagdo'); //批量为用户打标签
    Route::any('setag','Admin\\MenuAdminController@setag'); //查询创建的标签
    Route::any('menubardian','Admin\\MenuAdminController@menubardian'); //创建个性菜单
    Route::any('menulist','Admin\\MenuAdminController@getMenuList'); //查询自定义菜单
    Route::any('menuindex','Admin\\MenuAdminController@index'); //查询自定义菜单
    Route::any('sendall','Admin\\GroupController@sendall'); //根据openID群发消息
    Route::any('sendalltag','Admin\\GroupController@sendallTag'); //根据openID群发消息
    Route::any('openidlist','Admin\\OpenidController@openidlist'); //openid列表
    Route::any('openidlabel','Admin\\OpenidController@openidlabel'); //根据openID群发消息
    Route::any('labellist','Admin\\TagController@labellist'); //后台添加标签
    Route::any('label','Admin\\TagController@label'); //后台添加标签执行
    Route::any('labeltable','Admin\\TagController@labeltable'); //标签展示
    Route::any('tagslist','Admin\\TagController@tagslist'); //根据标签群发消息展示
    Route::any('tags','Admin\\TagController@tags'); //根据标签群发消息执行
    Route::any('labeldel/{id}','Admin\\TagController@labeldel'); //标签删除
    Route::get('wxlogin','Admin\\WechatAdminController@wxlogin'); //授权登录返回code
    Route::any('accredit','Admin\\WechatAdminController@accredit'); //授权登录接受code
    Route::get('wxregister', 'Admin\\LoginAdminController@index'); //code获取token
    Route::post('useraccredit', 'Admin\\LoginAdminController@useraccredit'); //接受wxregister传的值
});

//考试专用
Route::prefix('text')->group(function(){

});

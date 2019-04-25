<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tools\alipay\wappay\service\AlipayTradeService;
use App\Tools\alipay\wappay\buildermodel\AlipayTradeWapPayContentBuilder;

class AliPayController extends Controller
{
    //手机支付
    public function mobilpay(Request $Request){
        header("Content-type: text/html; charset=utf-8");

        $config=config('alipay');
      
            //商户订单号，商户网站订单系统中唯一订单号，必填
            $out_trade_no = time().date('ymd').rand(1111,9999);

            //订单名称，必填
            $subject = 'This is a demo alipay';
            // echo $subject;exit;

            //付款金额，必填
            $total_amount = 100;//$_POST['WIDtotal_amount']

            //商品描述，可空
            $body = NULL;//$_POST['WIDbody']

            //超时时间
            $timeout_express="1m";

            $payRequestBuilder = new AlipayTradeWapPayContentBuilder();
            $payRequestBuilder->setBody($body);
            $payRequestBuilder->setSubject($subject);
            $payRequestBuilder->setOutTradeNo($out_trade_no);
            $payRequestBuilder->setTotalAmount($total_amount);
            $payRequestBuilder->setTimeExpress($timeout_express);

            $payResponse = new AlipayTradeService($config);
            $result=$payResponse->wapPay($payRequestBuilder,$config['return_url'],$config['notify_url']);

            return ;
    }
    
    //同步回调
    public function re(){
        echo 1;
        // return view('paysuccess');//跳回支付成功页面
    }

    //异步回调
    public function notify(){
        echo 2;
    }






}

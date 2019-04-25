<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Wechar;
use App\Model\Subscribe;
use App\Model\OrderDetail;
use App\Http\Controllers\Controller;
use App\Model\Index;
use App\Model\AdminUser;
use Illuminate\Validation\Rules\In;

class WecharController extends Controller
{

    public function valid()
    {
        //cho 1;die;
        //$echostr=$_GET['echostr'];
        //if($this->checkSignature()){
        // echo $echostr;exit;
        //}
        //调用微信公众号回复
        $this->responMsg();
    }

    /*
     * @content 公众号自动回复
     */
    public function responMsg()
    {
        //获取微信请求的所有内容
        $postStr=file_get_contents("php://input");
        $postObj=simplexml_load_string($postStr);
        $toUsername=$postObj->ToUserName; //我的微信号id
        $fromUsername=$postObj->FromUserName; //请求消息的用户
        $time=time(); //时间戳
        $keywords=$postObj->Content;
        $PicUrl=$postObj->PicUrl;//获取接受的图片消息的路径
        $type=$postObj->MsgType;
/*        $content=[];
        if($type=="text"){
            $filename=public_path().'/recode/'.date('Ymd').'.php';
            $content[]=[
                'openid'=>$fromUsername,
                'time'=>$time,
                'content'=>$keywords
            ];
            $str = json_encode($content,JSON_UNESCAPED_UNICODE)."\n";
            file_put_contents($filename,$str,FILE_APPEND);
        }*/
        $MsgType="text";
        $textTpl="<xml>
                  <ToUserName><![CDATA[%s]]></ToUserName>
                  <FromUserName><![CDATA[%s]]></FromUserName>
                  <CreateTime>%s</CreateTime>
                  <MsgType><![CDATA[%s]]></MsgType>
                  <Content><![CDATA[%s]]></Content>
            </xml>";

        //关注公众号自动回复消息
        if($postObj->MsgType=='event'){
            if($postObj->Event=='subscribe'){
                $use_info=AdminUser::where('openid',$fromUsername)->first();
                if(empty($use_info)){
                    $contentStr="尊敬的用户您好，凉栀感谢您的使用，首次关注需要您绑定本网站的账户，以便更方便的为您提供服务 请点击这儿"."<a href='http://jqq.52lxr.cn/admin/wxregister?openid='$fromUsername>点击绑定</a>";
                }else{
                    $contentStr="欢迎".$use_info['u_name']."回来";
                }
                //$contentStr = "欢迎来到洛克王国";
                $resultStr  = sprintf($textTpl,$fromUsername,$toUsername,$time,$MsgType,$contentStr);
                echo $resultStr;
            }elseif($postObj->Event=='CLICK'){
                $eventKey=$postObj->EventKey;
                if($eventKey=='新品推荐'){
                    //回复图文消息5条
                    $data=Index::orderBy('goods_id','desc')->limit(5)->get();
                    $item_str="<item>
                                  <Title><![CDATA[%s]]></Title>
                                  <Description><![CDATA[%s]]></Description>
                                  <PicUrl><![CDATA[%s]]></PicUrl>
                                  <Url><![CDATA[%s]]></Url>
                              </item>";
                    $item="";
                    foreach($data as $k=>$v){
                        $item.=sprintf($item_str,$v['goods_name'],$v['goods_desc'],
                            ("http://mmbiz.qpic.cn/mmbiz_jpg/8B4ghUJC6K9obRelSsWaLVxe6cS8ibQplkEwZgicuCAnPQcWibRs4BdWayvY6d2DEqDyf7uXZzagqkbTRHq0fKuibg/0?wx_fmt=jpeg"),
                            "http://jqq.52lxr.cn/index/shopcontent/$v->goods_id");
                    }
                    $textTpl="<xml>
                          <ToUserName><![CDATA[%s]]></ToUserName>
                          <FromUserName><![CDATA[%s]]></FromUserName>
                          <CreateTime><![CDATA[%s]]></CreateTime>
                          <MsgType><![CDATA[%s]]></MsgType>
                          <ArticleCount>5</ArticleCount>
                          <Articles>
                              $item
                          </Articles>
                       </xml>";
                    $MsgType="news";
                    $resultStr  = sprintf($textTpl,$fromUsername,$toUsername,$time,$MsgType,$item);
                    echo $resultStr;
                    exit();
                }
            }
        }elseif($postObj->MsgType=='image'){
            $re = file_get_contents($PicUrl);
            $filename=public_path().'/picurl/'.time().'.jpg';
            file_put_contents($filename,$re);
            $contentStr = "好了，我收到了";
            $resultStr  = sprintf($textTpl,$fromUsername,$toUsername,$time,$MsgType,$contentStr);
            echo $resultStr;
            exit();
        }

        //关键词自动回复消息
        if($keywords=='你好'){//关键词回复
            $contentStr = "我不好";
            $resultStr  = sprintf($textTpl,$fromUsername,$toUsername,$time,$MsgType,$contentStr);
            echo $resultStr;
            exit();
        }elseif(strpos($keywords,"天气")){
            //获取城市名称
            $city=Wechar::getcityName($keywords);
            //获取城市代码
            $code = Wechar::getcityweacher($city);
            $contentStr = $code;
            $resultStr  = sprintf($textTpl,$fromUsername,$toUsername,$time,$MsgType,$contentStr);
            echo $resultStr;
            exit();
        }elseif($keywords=="图片"){
            $textTpl="<xml>
                          <ToUserName><![CDATA[%s]]></ToUserName>
                          <FromUserName><![CDATA[%s]]></FromUserName>
                          <CreateTime><![CDATA[%s]]></CreateTime>
                          <MsgType><![CDATA[%s]]></MsgType>
                          <Image>
                              <MediaId><![CDATA[%s]]></MediaId>
                          </Image>
                      </xml>";
            $MsgType='image';
            //$mediaid="flkkt-kVHmcW_i5utKT1yamd1vRAfZieTQkmDjv4K7K6Z9Ef1bTSPoxL5pEEkX1m";
            $mediaid="Vy6gi0-XlXN8XUBxefNktV3ICV7DXhrPQgZtdChlFdM";
            $resultStr  = sprintf($textTpl,$fromUsername,$toUsername,$time,$MsgType,$mediaid);
            echo $resultStr;
            exit();
        }elseif($keywords=='图文'){
            $textTpl="<xml>
                          <ToUserName><![CDATA[%s]]></ToUserName>
                          <FromUserName><![CDATA[%s]]></FromUserName>
                          <CreateTime><![CDATA[%s]]></CreateTime>
                          <MsgType><![CDATA[%s]]></MsgType>
                          <ArticleCount>1</ArticleCount>
                          <Articles>
                              <item>
                                  <Title><![CDATA[%s]]></Title>
                                  <Description><![CDATA[%s]]></Description>
                                  <PicUrl><![CDATA[%s]]></PicUrl>
                                  <Url><![CDATA[%s]]></Url>
                              </item>
                          </Articles>
                       </xml>";
            $MsgType="news";
            $des="欢迎";
            $picurl=url('/uploads/20190411/8471.jpg');
            $title="我的动态";
            $url="http://www.4399.com";
            $resultStr  = sprintf($textTpl,$fromUsername,$toUsername,$time,$MsgType,$title,$des,$picurl,$url);
            echo $resultStr;
            exit();
        }elseif($keywords=="最新商品"){
            $data=Index::orderBy('goods_id','desc')->first();
            $textTpl="<xml>
                          <ToUserName><![CDATA[%s]]></ToUserName>
                          <FromUserName><![CDATA[%s]]></FromUserName>
                          <CreateTime><![CDATA[%s]]></CreateTime>
                          <MsgType><![CDATA[%s]]></MsgType>
                          <ArticleCount>1</ArticleCount>
                          <Articles>
                              <item>
                                  <Title><![CDATA[%s]]></Title>
                                  <Description><![CDATA[%s]]></Description>
                                  <PicUrl><![CDATA[%s]]></PicUrl>
                                  <Url><![CDATA[%s]]></Url>
                              </item>
                          </Articles>
                       </xml>";
            $MsgType="news";
            $des=$data->goods_desc;
            $title=$data->goods_name;
            $picurl="http://mmbiz.qpic.cn/mmbiz_jpg/8B4ghUJC6K9obRelSsWaLVxe6cS8ibQplkEwZgicuCAnPQcWibRs4BdWayvY6d2DEqDyf7uXZzagqkbTRHq0fKuibg/0?wx_fmt=jpeg";
            $url="http://jqq.52lxr.cn/index/shopcontent/$data->goods_id";
            $resultStr  = sprintf($textTpl,$fromUsername,$toUsername,$time,$MsgType,$title,$des,$picurl,$url);
            echo $resultStr;
            exit();
        }elseif(strstr($keywords,'订单')){
            //获取订单号
            $ordernum = Wechar::GetOrderNum($keywords);
            //通过订单号获取订单详细信息
            $orderinfo=OrderDetail::GetOrderInfo($ordernum);
            OrderDetail::Ordertpl($fromUsername,$orderinfo);
        }else{//机器人回复
            $url="http://openapi.tuling123.com/openapi/api/v2";
            $data=[
                'perception'=>[
                    'inputText'=>[
                        'text'=>$keywords
                    ]
                ],
                'userInfo'=>[
                    'apiKey'=>"9c866a625710420ca77b43380cd256bd",
                    'userId'=>"123456"
                ]
            ];
            $post_data=json_encode($data);
            $res=Wechar::HttpPost($url,$post_data);
            $msg=json_decode($res,true)['results'][0]['values']['text'];
            $contentStr=$msg;
            $resultStr  = sprintf($textTpl,$fromUsername,$toUsername,$time,$MsgType,$contentStr);
            echo $resultStr;
        }
    }

    /*
     * @content 微信
     * */
    private function checkSignature()
    {
        $signature=$_GET["signature"];
        $timestamp=$_GET["timestamp"];
        $nonce=$_GET["nonce"];

        $token=12345678;

        //将三个参数放入数组
        $arr=array($token,$timestamp,$nonce);
        //字典排序
        sort($arr,SORT_STRING);
        //拼接参数
        $str=implode($arr);
        //sha1加密
        $sign=sha1($str);
        if($sign==$signature){
            return true;
        }else{
            return false;
        }
    }


}

<?php
namespace App\Model;

use function GuzzleHttp\Psr7\str;
use Illuminate\Support\Facades\Storage;
use CURLFile;
use App\Model\Index;


class Wechar
{
    /*
     * @content 封装一个post请求
     */
    public static function HttpPost($url,$post_data){
        //初始化
        $curl = curl_init();
        //设置抓取的url
        curl_setopt($curl, CURLOPT_URL, $url);
        //设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_HEADER, 0);
        //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //设置post方式提交
        curl_setopt($curl, CURLOPT_POST, 1);
        //设置post数据
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
        // https请求 不验证证书和hosts
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        //执行命令
        $data = curl_exec($curl);
        //关闭URL请求
        curl_close($curl);
        //显示获得的数据
        return $data;

        return $url;

    }

    /*
     * @content 获取要获取天气的城市
     * @params $str(控制器传来的keywords) string 用户输入的含有城市名称的名字
     * */
    public static function getcityName($str){
        //获取天气城市的名称方式 截取
        //$city=substr($str,0,strpos($str,'天气'));
        //数组
        $arr=explode('天气',$str);
        $city=$arr[0];

        return $city;
    }

    /*
     * @content 天气接口
     */
    public static function getcityweacher($city)
    {
        $url="http://api.k780.com/?app=weather.today&weaid=$city&appkey=41458&sign=7191d482a75ac37116c75da51cd27202&format=json";
        $data=file_get_contents($url);
        $data=json_decode($data,true);
        $code=$data['success'];
        if($code){
            $result=$data['result'];
            $str=$city."今天是".$result['days']."日".$result['week']."\r\n";
            $str.="天气".$result['weather']."\r\n";
            $str.="最高气温".$result['temp_high']."\r\n";
            $str.="最低气温".$result['temp_low']."\r\n";
            $str.=$result['wind'];
        }else{
            $str="你所处的地方是地球";
        }

        return $str;
    }

    /*
     * @content 存access_token
     * */
    public static function CreatAccessToken()
    {
        $path=public_path()."/weixin";
        $filename=$path."/token.txt";
        $str=file_get_contents($filename);
        if(!empty($str)){
            $now=time();
            $data=json_decode($str,true);
            //已过期
            if($now>$data['expire']){
                $token=self::GetAccessToken();
                $expire=time()+7100;
                $arr=['token'=>$token,'expire'=>$expire];
                $str=json_encode($arr);
                file_put_contents($filename,$str);
            }else{
                //没过期
                $token=$data['token'];
            }
        }else{
            //生成token
            $token=self::GetAccessToken();
            $expire=time()+7100;
            $arr=['token'=>$token,'expire'=>$expire];
            $str=json_encode($arr);
            file_put_contents($filename,$str);
        }
        return $token;
    }

    /*
     * @content 生成access_token
     * @params 获取access_token
     * */
    public static function GetAccessToken(){
        $appid= env('WXAPPID');
        $appsecret=env('WXAPPSECRET');
        $url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
        $re=file_get_contents($url);
        $token=json_decode($re,true)['access_token'];
        return $token;
    }

    /*
     * @content 获取素材的类型
     * @params  素材的类型
     * */
    public static function GetType($str)
    {
        $filetype=explode('/',$str);//数组array:2 [0 => "文件类型",1 => "png"]
        $filetype=$filetype[0];
        $arr=[
            'audio'=>'audio',
            'image'=>'image',
            'video'=>'video'
        ];

        return $arr[$filetype];
    }

    /*
     * @content 文件上传
     * */
    public static function uploadfile($file){
        //获取文件类型
        $data=$file->getClientMimeType();
        //dd($data);
        //获取文件后缀名
        $ext=$file->getClientOriginalExtension();
        //dd($ext);
        //获取临时文件的位置
        $path=$file->getRealPath();
        //dd($path);
        //上传后的文件名称
        $newfilename=date('Ymd')."/".mt_rand(1111,9999).".".$ext;
        //dd($newfilename);
        //上传
        Storage::disk('uploads')->put($newfilename,file_get_contents($path));
        $imgpath=public_path().'/uploads/'.$newfilename;
        $data=['data'=>$data,'imgpath'=>$imgpath];

        return $data;
    }

    /*
     * @content 获取用户基本信息
     * */
    public static function GetUser()
    {
        $token=self::CreatAccessToken();
        $url="https://api.weixin.qq.com/cgi-bin/user/info?access_token=$token&openid=OPENID&lang=zh_CN";
        $res = file_get_contents($url);
    }

    /*
     * @content 获取用户列表
     * */
    public static function GetOpenIdList()
    {
        $token=self::GetAccessToken();
        $url="https://api.weixin.qq.com/cgi-bin/user/get?access_token=$token";
        $re=file_get_contents($url);
        $data=json_decode($re,true);

        return $data['data']['openid'];
    }
    
    /*
     * @content 获取
     * */
    public static function GetMediaId()
    {
        $token=self::CreatAccessToken();
        $url="https://api.weixin.qq.com/cgi-bin/media/uploadnews?access_token=$token";
        $postjson='{
            "articles": [     {
                "thumb_media_id":"qI6_Ze_6PtV7svjolgs-rN6stStuHIjs9_DidOHaj0Q-mwvBelOXCFZiq2OsIU-p",
                "title":"晚上好",       
                "content":"大家晚上好",
                },     
            ]
        }';
        $re = self::HttpPost($url,$postjson);
        $data = json_encode($re,true);

        return $data['data']['openid'];
    }

    /*
     * @content 模板消息
     * */
    public static function GetOrderNum($keywords)
    {
        $pattern="/^订单(\\d+)$/";
        preg_match($pattern,$keywords,$result);

        return $result[1];
    }

    /*
     * @content 回复新品
     */
    static public function getOrder($FromUserName,$ToUserName,$time)
    {
        $info=Index::orderBy('goods_id','desc')->limit(5)->get();//create_time   ->toArray()
        $itemTpl = "<item>
                    <Title><![CDATA[%s]]></Title>
                    <Description><![CDATA[%s]]></Description>
                    <PicUrl><![CDATA[%s]]></PicUrl>
                    <Url><![CDATA[%s]]></Url>
                </item>";
        $item_str = "";
        foreach ($info as $v){
            $item_str .= sprintf($itemTpl,$v['goods_name'],$v['goods_desc'],
                ("http://nichousha.xyz/images/goodsLogo/".$v['goods_img']),
                "http://nichousha.xyz/shopcontent/".$v['goods_id']);
        }
        $xmlTpl = "<xml>
                <ToUserName><![CDATA[%s]]></ToUserName>
                <FromUserName><![CDATA[%s]]></FromUserName>
                <CreateTime>%s</CreateTime>
                <MsgType><![CDATA[news]]></MsgType>
                <ArticleCount>5</ArticleCount>
                <Articles>
                    $item_str
                </Articles>
               </xml>";

        $result = sprintf($xmlTpl,$FromUserName,$ToUserName,$time);
        echo $result;
    }

}
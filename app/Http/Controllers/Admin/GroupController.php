<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Wechar;

class GroupController extends Controller
{
    /*
     * @content 根据openID群发消息
     * */
    public function sendall(Request $request)
    {
        //$res=$request->type;
        $token=Wechar::CreatAccessToken();
        $send_url="https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token=$token";
        //调用openIDlist
        $openidList=Wechar::GetOpenIdList();
        $text=[
            'touser'=>$openidList,
            "msgtype"=>"text",
            'text'=>[
                'content'=>'莫问前程，但行好事'
            ]
        ];
        /*$media=Wechar::GetMediaId();
           switch ($res){
            case "text":
                $data = [
                    "touser"=>[
                        $openidList
                    ],
                    "msgtype"=>"text",
                    "text"=> [
                        "content"=>$text
                    ]
                ];
                $json = json_encode($data,JSON_UNESCAPED_UNICODE);
                $post = Wechat::HttpPost($url,$json);
                var_dump($post);
                break;
        }*/
        /*$news=[
            'touser'=>$openidList,
            'mpnews'=>[
                'media_id'=>$media
            ],
            'msgtype'=>'mpnews',
            "send_ignore_reprint"=>0
        ];*/
        $postjson=json_encode($text,JSON_UNESCAPED_UNICODE);//第一个参数为数组变量
        $re = Wechar::HttpPost($send_url,$postjson);
        echo $re;

    }

    /*
     * @content 根据标签群发消息
     * */
    public function sendallTag()
    {
        $token=Wechar::CreatAccessToken();
        $url="https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token=$token";
                $data=[
                    'filter'=>[
                        'is_to_all'=>false,
                        'tag_id'=>101
            ],
            'text'=>[
                'content'=>'rrrrrrr'
            ],
            'msgtype'=>'text'
        ];
        $datajson=json_encode($data,JSON_UNESCAPED_UNICODE);

        $re = Wechar::HttpPost($url,$datajson);
        echo $re;
    }


}

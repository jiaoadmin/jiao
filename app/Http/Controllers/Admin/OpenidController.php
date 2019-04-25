<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Wechar;

class OpenidController extends Controller
{
    /*
     * @content 获取用户信息
     **/
    public function openidlist(){
        //获取access_token
        $access_token = Wechar::CreatAccessToken();
        //echo $access_token;
        //获取openid列表
        $url = "https://api.weixin.qq.com/cgi-bin/user/get?access_token=$access_token";
        //echo $url;
        //get
        //$res = Wechar::sendget($url);
        $res=file_get_contents($url);
        //var_dump($res);exit;
        //获取openid
        $openid = json_decode($res,true)['data']['openid'];
        //print_r($openid) ;
        //根据openid获取用户信息
        $userurl = "https://api.weixin.qq.com/cgi-bin/user/info/batchget?access_token=$access_token";
        //数据
        foreach($openid as $k=>$v){
            $data[]=[
                "openid"=>$v,
                "lang"=>"zh_CN"
            ];
        }
        $arr = [
            'user_list'=>$data
        ];
        //print_r($arr);exit;
        //转换成json
        $json = json_encode($arr,JSON_UNESCAPED_UNICODE);
        //var_dump($json);
        //post
        $info = Wechar::HttpPost($userurl,$json);
        //转换成数组
        $arr = json_decode($info,true);
        //var_dump($arr);exit;
        //循环数据传到view层
        foreach ($arr as $k=>$v){
            $user_arr = $v;
        }
        //var_dump($user_arr);

        //获取标签接口
        $url="https://api.weixin.qq.com/cgi-bin/tags/get?access_token=$access_token";
        //echo $url;
        //
        $res = file_get_contents($url);
        //var_dump($res);exit;
        //转换成数组
        $data = json_decode($res,true);
        //var_dump($arr);*/
        foreach ($data as $k =>$v){
            return view('admin.openidlist',['user_arr'=>$user_arr,'data'=>$v]);
        }
    }

    /*
     * @content 给用户添加标签
     **/
    public function openidlabel(Request $request){
        $openid = $request->input('openid');
        $label = $request->input('label');
        /*var_dump($openid);
        var_dump($label);*/

        //获取access_token
        $access_token = Wechar::CreatAccessToken();
        //echo $access_token;
        //给用户打标签接口
        $url="https://api.weixin.qq.com/cgi-bin/tags/members/batchtagging?access_token=$access_token";
        //echo $url;
        //数据
        $data = [
            "openid_list"=>$openid,
            "tagid"=>$label
        ];
        //转换成json格式
        $json = json_encode($data,JSON_UNESCAPED_UNICODE);
        //var_dump($json);
        //post
        $res = Wechar::HttpPost($url,$json);
        //var_dump($res);
        $ass = json_decode($res,true);
        if($ass['errcode']==0){
            echo '1';
        }else{
            echo'2';
        }
    }
    

}

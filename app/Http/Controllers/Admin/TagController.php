<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Wechar;

class TagController extends Controller
{
    /*
     * @content 后台添加标签展示页面
     * */
    public function labellist(){
        return view('admin.label');
    }

    /*
     * @content 添加执行
     * */
    public function label(Request $request){
        //接受值
        $text = $request->input('text');
        //获取access_token
        $access_token = Wechar::CreatAccessToken();
        // echo $access_token;
        //调用接口
        $url = "https://api.weixin.qq.com/cgi-bin/tags/create?access_token=$access_token";
        //数据
        $data = [
            "tag"=>[
                "name"=>$text
            ]
        ];
        //var_dump($data);
        //转换成json格式
        $json = json_encode($data,JSON_UNESCAPED_UNICODE);
        //var_dump($json);
        //post传值
        $res = Wechar::HttpPost($url,$json);
        if($res){
            echo '添加成功';
            //header("refresh:1;url='/admin/labeltable'");
        }
    }

    /*
     * @content 标签展示
     * */
    public function labeltable()
    {
        //获取access_token
        $access_token = Wechar::CreatAccessToken();
        // echo $access_token;
        //展示标签接口
        $url="https://api.weixin.qq.com/cgi-bin/tags/get?access_token=$access_token";
        //echo $url;
        $res = file_get_contents($url);
        $data = json_decode($res,true);
        foreach ($data as $k => $v){
            return view('admin.labellist',['data'=>$v]);
        }

    }

    /*
     * @content 标签删除
     * */
    public function labeldel($id){
        //获取access_token
        $access_token = Wechar::CreatAccessToken();
        // echo $access_token;
        //删除标签
        $url = "https://api.weixin.qq.com/cgi-bin/tags/delete?access_token=$access_token";
        //数据
        $data=[
            "tag"=>[
                "id"=>$id
            ]
        ];
        //var_dump($data);
        //将数据转换成json
        $json = json_encode($data,JSON_UNESCAPED_UNICODE);
        //var_dump($json);
        $res = Wechar::HttpPost($url,$json);
        //var_dump($res);
        $ass = json_decode($res,true);
        if($ass['errcode']==0){
            echo '删除成功';
            header("refresh:1;url='/admin/labeltable'");
        }
    }

    /*
     * @content 根据标签群发消息展示
     * */
    public function tagslist()
    {
        //查出有什么标签
        $token=Wechar::CreatAccessToken();
        $url="https://api.weixin.qq.com/cgi-bin/tags/get?access_token=$token";
        $re = file_get_contents($url);
        $data=json_decode($re,true);
        foreach($data as $k=>$v){
            return view('admin.tagslist',['data'=>$v]);
        }

    }

    /*
     * @content 根据标签群发消息执行
     * */
    public function tags(Request $request)
    {
        $tags=$request->input('tags');
        dd($tags);
        //获取token
        $token = Wechar::CreatAccessToken();
        //根据标签群发消息的url
        $url="https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token=$token";
        //data
        $data=[
            'filter'=>[
                'is_to_all'=>false,
                'tag_id'=>101
            ],
            'text'=>[
                'content'=>'女生'
            ],
            'msgtype'=>'text'
        ];
        $datajson=json_decode($data,JSON_UNESCAPED_UNICODE);
        //curl的post请求
        $re = Wechar::HttpPost($url,$datajson);
        echo $re;
    }


}

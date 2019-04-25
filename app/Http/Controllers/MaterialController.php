<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Wechar;
use Illuminate\Support\Facades\Storage;
use CURLFile;

class MaterialController extends Controller
{
    /*
     * @content 调用access_token
     * */
    public function upload_media()
    {
        $res=Wechar::CreatAccessToken();//获取存好的access_token
        var_dump($res);
    }

    /*
     * @content 新增临时素材
     * */
    public function index()
    {
        return view('material.index');
    }

    /*
     * @content 新增临时素材
     * */
    public function material(Request $Request)
    {
        $file=$Request->material;//音频：audio，图片：image，视频：video，

        $re = Wechar::uploadfile($file);
        $imgpath=$re['imgpath'];
        $data=$re['data'];
        //获取access_token
        $access_token=Wechar::CreatAccessToken();
        //获取文件的类型
        //$type=Wechar::GetType($data);
        $type = 'thumb';

        $url="https://api.weixin.qq.com/cgi-bin/media/upload?access_token=$access_token&type=$type";
        $data=['media'=>new CURLFile(realpath($imgpath))];
        $res = Wechar::HttpPost($url,$data);
        //dd($res);
        $result=json_decode($res,true);
        //dd($result);
        if(isset($result['errcode'])){
            die($result['errmsg']);
        }else{
            $media_id=$result['media_id'];
            echo $media_id;
        }


    }

}
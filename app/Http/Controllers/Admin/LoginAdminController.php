<?php

namespace App\Http\Controllers\Admin;

use App\Model\Wechar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\AdminUser;

class LoginAdminController extends Controller
{
    public function index(Request $request)
    {
        $re = $request->openid;
        //var_dump($re);
        session(['openid'=>$re]);
        return view('admin.wxregister');
    }

    public function useraccredit(Request $request)
    {
        $code=$request->code;
        $tel =$request->tel;
        $openid=session('openid');
        //var_dump($openid);exit;
        $token=Wechar::CreatAccessToken();
        $url="https://api.weixin.qq.com/cgi-bin/user/info?access_token=$token&openid=$openid&lang=zh_CN";
        $re = file_get_contents($url);
        $useinfo=json_decode($re,true);
        //dd($useinfo);
        $nickname=$useinfo['nickname'];

        $data=[
            'u_name'=>$nickname,
            'openid'=>$openid,
            'tel' =>$tel
        ];
        $res=AdminUser::insert($data);
        if($res){
            /*echo json_encode(['font'=>'绑定成功','code'=>1]);*/
            return redirect('http://jqq.52lxr.cn/');
        }else{
            /*echo json_encode(['font'=>'绑定失败','code'=>2]);*/
            return redirect('http://jqq.52lxr.cn/admin/wxregister');
        }


    }
}

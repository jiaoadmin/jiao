<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Wechar;
use CURLFile;
use App\Model\Subscribe;
use App\Model\Login;

class WechatAdminController extends Controller
{
    /*
     * @content 后台首页
     * */
    public function index(){
        return view('admin.index');
    }

    /*
     * @content 添加素材
     * */
    public function material()
    {
        return view('admin.material');
    }

    /*
    * @content 永久素材上传
    * */
    public function upl(Request $request)
    {
        if($request->hasFile('material')){
            $file=$request->material;
            //dd($file);
            $re=Wechar::uploadfile($file);
            $imgpath = $re['imgpath'];
            $data    = $re['data'];
            //获取access_token
            $access_token=Wechar::CreatAccessToken();
            //dd($access_token);
            //获取文件的类型
            $type=Wechar::GetType($data);
            //dd($type);
            $url="https://api.weixin.qq.com/cgi-bin/material/add_material?access_token=$access_token&type=$type";
            $data=['media'=>new CURLFile(realpath($imgpath))];
            //dd($data);//返回
            $res = Wechar::HttpPost($url,$data);
            $data=json_decode($res,true);
            //var_dump($data);exit;//返回的有media_id  url
            $data=[
                'type'=>$request->input('type',null),
                'media_id'=>$data['media_id'],
                'url'=>$request->input('url',null),
                'picurl'=>$data['url'],
                'des'=>$request->input('des',null),
                'title'=>$request->input('title',null),
            ];
            
            $res = Subscribe::insert($data);

            if($res){
                echo "成功";
                //header(url(''));
            }else{
                echo "失败";
            }


        }
    }

    //我的桌面
    public function welocome()
    {
        return view('admin.welcome');
    }

    /*
     * @content 关注回复类型
     * */
    public function wxtype()
    {
        $data=config('wechat.subscribe');

        return view('admin.xtype',['type'=>$data]);
    }

    /*
     * @content 确认回复的方式
     * */
    public function typedo(Request $request)
    {
        $type=$request->type;
        $path=config_path('wechat.php');
        $config=[];
        $config['subscribe']=$type;
        $str='<?php  return '.var_export($config,true)."; ?>";

        file_put_contents($path,$str);
        return $path;
    }


    /*
     *@content 获取code
     * */
   public function wxlogin()
    {
        $appid=env('WXAPPID');
        $redirect_url=urlEncode('http://jqq.52lxr.cn/admin/accredit');
        $url="https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$redirect_url&response_type=code&scope=snsapi_userinfo&state=123123#wechat_redirect";

    }

    /*
     *@content 授权登录
     * */
    public function accredit(Request $request)
    {
        //网站和第三方建立连接
        //用户发起请求，选择登录方式
        //网站请求第三方服务提供商
        //第三方请求用户授权
        //用户授权成功
        //第三方返回code给网站
        //网站根据code生成access_token
        //网站使用token请求第三方服务提供商
        //第三方返回非关键的用户信息
        //成功
        //获取code
        $code = $request->code;
        //dd($code);
        $appid=env('WXAPPID');
        $appsecret=env('WXAPPSECRET');
        $url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$appsecret&code=$code&grant_type=authorization_code";
        $re = file_get_contents($url);
        //dd($re);
        $arr=json_decode($re,true);
        $access_token=$arr['access_token'];
        $openid=$arr['openid'];
        //dd($openid);
        //获取用户信息
        $newurl="https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openid&lang=zh_CN";
        $userinfo=file_get_contents($newurl);
        $use_info=json_decode($userinfo,JSON_UNESCAPED_UNICODE);

        //判断是否绑定
        $re=AdminUser::where('openid',$userinfo['openid'])->first();
        var_dump($re);exit;
        if(empty($re)){
            return view('admin.wxregister',['userinfo'=>$userinfo]);
        }else{
            session(['user_id'=>$re->user_id,'user_name'=>$re->user_name]);
            return redirect('/');
        }

    }

    /*
     * @绑定用户
     */
    public function wxloginDo(Request $request)
    {
        $user_tel=$request->userMobile;
        $openid=$request->openid;
        $res=Users::where('user_tel',$user_tel)->update(['openid'=>$openid]);
        if($res){
            echo json_encode(['font'=>'绑定成功','code'=>1]);
        }else{
            echo json_encode(['font'=>'绑定失败','code'=>2]);
        }
    }

    /*public function wxlogin(Request $request)
    {
        //判断是否绑定
        $re=Users::where('openid',$userinfo['openid'])->first();
        if(empty($re)){
            return view('wechat.wxregister',['userinfo'=>$userinfo]);
        }else{
            session(['user_id'=>$re->user_id,'user_name'=>$re->user_name]);
            return redirect('/');
        }
    }*/




}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Model\Login;

class LoginController extends Controller
{
    /**登录 */
    public function login(Request $request)
    {
        return view('login');
    }

    /**登录验证 */
    public function logindo(Request $Request){
        $name=$Request->post('name');
        $pwd1=$Request->post('pwd');
        $pwd=md5($pwd1);
//        $verifycode=$Request->post('verifycode');
//        $session=session('verifycode');
//        // var_dump($session);exit;
//        if($verifycode!=$session){
//            echo 4;exit; //4表示与存的session值不相同
//        }
        $res=Login::where('name','=',$name)->first();
        if(empty($res)){
            echo 1;exit; //1表示没数据
        }else if($pwd!=$res['pwd']){
            echo 2;exit; //2表示密码错误
        }else{
            echo 3;  //3表示正确
            session(['user_id'=>$res['id']]);
        }

    }

    /**注册 */
    public function register()
    {
        return view('register');
    }

    /**注册验证 */
    public function registerdo(Request $Request){
        $data=$Request->post();
        // var_dump($data);exit;
        unset($data['_token']);
        $data['pwd']=md5($data['pwd']);//encrypt
        // var_dump($data);exit;
        $sessio=session('code');
        if(empty($sessio)){
            echo "验证码已无效，请重新发送";exit;
        }else if($data['name']==$sessio['name']){
            echo "请填写正确的验证码";exit;
        }else if($data['code']==$sessio['code']){
            echo "请输入正确验证码"; exit;
        }
        unset($data['code']);

        $res=Login::insert($data);
        if($res){
            echo 1;
        }else{
            echo 2;exit;
        }

    }

    /**验证码 */
    public function code(Request $Request){
        $phone=$Request->name;
        // var_dump($phone);exit;
        $code=rand(1000,9999);
        session(['code'=>$code,"name"=>$phone],60);
        $this->sendMobile($code,$phone);
    }

    /*
     * @content 发送手机验证码
     * @params  $mobile  要发送的手机号
     * 
     * */
    private function sendMobile($code,$phone)
    {
        $host = env("MOBILE_HOST");
        $path =env("MOBILE_PATH") ;
        $method = "POST";
        $appcode = env("MOBILE_APPCODE");
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "content=【创信】你的注册验证码是：".$code."，1分钟内有效，请及时输入！&mobile=".$phone;
        $bodys = "";
        $url = $host . $path . "?" . $querys;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        var_dump(curl_exec($curl));
    }

    /**重置密码 */
    public function updpwd(){
        return view('resetpassword');
    }




}

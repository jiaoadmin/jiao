<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\UserAddress;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    /**个人收货地址 */
    public function address(){
        $user_id=session('user_id');
        // echo $user_id;exit;
        $data=UserAddress::where('user_id',$user_id)->get();
        // var_dump($data);exit;
        return view('address',['data'=>$data]);
    }

    /**潮购记录 */
    public function buyrecord(){
        return view('buyrecord');
    }

    /**删除个人资料 */
    public function del(Request $Request){
        $address_id=$Request->address_id;
        // var_dump($address_id);
        $res=UserAddress::where('address_id',$address_id)->delete();
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }

    /**点击编辑 */
    public function edituser($id){
        $data=UserAddress::where('address_id',$id)->first();
        // var_dump($data);exit;
        return view('edituser',['data'=>$data]);
    }

    //点击设置默认
    public function default(Request $Request){
        // echo "1111";exit;
        $address_id=$Request->address_id;
        $user_id=session('user_id');
        $where=[
            'address_id'=>$address_id,
            'user_id'=>$user_id
        ];
        $data=[
            'is_default'=>2
        ];
        DB::beginTransaction();
        $result=UserAddress::where('user_id',$user_id)->update($data);
        $res=UserAddress::where($where)->update(['is_default'=>1]);
        if($result!==false&&$res){
            DB::commit();
            echo 1;
        }else{
            DB::rollback();
            echo 2;
        }

    }

    /**添加用户收货地址 */
    public function useradd(){
        return view('user');
    }

    /**添加用户执行 */
    public function adddo(Request $Request){

    }

    /**我的钱包 */
    public function mywallet(){
        return view('mywallet');
    }
}

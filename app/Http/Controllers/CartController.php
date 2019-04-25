<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Cart;
use App\Model\Index;

class CartController extends Controller
{
    /*
    * @content 购物车展示
    * @params
    * */
    public function Shopcart()
    {
        //调用查询商品的方法
        $goodsInfo=$this->goodsInfo();
        // var_dump($goodsInfo);exit;
        return view('shopcart')->with('goodsInfo',$goodsInfo);
    }

    /**
     * 加入购物车
     * 接受id
     */
    public function cart(Request $Request){
        $goods_id=$Request->post('goods_id');
        $user_id=session('user_id');
        $data=[
            'goods_id'=>$goods_id,
            'user_id'=>$user_id,
            'create_time'=>time()
        ];
        $re=Cart::where('goods_id','=',$goods_id)->where('user_id','=',$user_id)->first();
        if(empty($re)){
            $res=Cart::insert($data);
            if($res){
                echo 1;
            }else{
                echo 2;
            }
        }else{
            $data=[
                'create_time'=>time(),
                'buy_number'=>$re['buy_number']+1
            ];
            $res=Cart::where('g_id','=',$re['g_id'])->update($data);
            if($res){
                echo 1;
            }else{
                echo 2;
            }
        }

        
        
    }


    /**查询商品信息 */
    public function goodsInfo(){
        $user_id=session('user_id');
        //两表联查
        $data=Cart::join('goods','cart.goods_id','=','goods.goods_id')
            ->where('user_id','=',$user_id)
            ->where('is_show',1)
            ->get();
        return $data;

    }

    /**删除 */
    public function del(Request $Request){
        $goods_id = $Request->goods_id;
        // var_dump($goods_id);exit;
        $user_id=session('user_id');
        // var_dump($user_id);exit;
        $data=[
            'is_show'=>2,
        ];
        $where=[
            'goods_id'=>$goods_id,
            'user_id'=>$user_id
        ];
        // var_dump($data);exit;
        // var_dump($where);exit;
        $res=Cart::where($where)->update($data);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }

    /**批删 */
    public function dels(Request $Request){
        $goods_id=$Request->goods_id;
        $goods_id=explode(',',$goods_id);
        // var_dump($goods_id);exit;
        $user_id=session('user_id');
        // var_dump($user_id);exit;
        $data=[
            'is_show'=>2,
        ];
        $res=Cart::whereIn('goods_id',$goods_id)
            ->where('user_id',$user_id)
            ->update($data);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }

    /**购买数量 */
    public function checknum(Request $Request){
        $buy_number=$Request->post('buy_number');
        $goods_id=$Request->post('goods_id');
        $user_id=session('user_id');
        
        $where=[
            'goods_id'=>$goods_id,
            'user_id'=>$user_id
        ];
        $data=[
            'buy_number'=>$buy_number
        ];
        $res=Cart::where($where)->update($data);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }

    /**支付 */
    public function payment(Request $Request){
        $goods_id=$Request->goods_id;
        $price=$Request->price;
        var_dump($price);
        // var_dump($goods_id);
        session(['goods_id'=>$goods_id]);
        
    }

    /**支付展示页面 */
    public function paymentshow(){
        $goods_id = session('goods_id');
        $goods_id=explode(',',$goods_id);
        // var_dump($goods_id);exit;
        $user_id = session('user_id');
        // var_dump($user_id);exit;
        $data=Index::join('cart','goods.goods_id','=','cart.goods_id')
            ->whereIn('cart.goods_id',$goods_id)
            ->where('cart.user_id',$user_id)
            ->where(['is_show'=>1])
            ->get();
        $allprice=0;
        foreach($data as $k=>$v){
            $allprice+=$v['goods_price']*$v['buy_number'];
        }
        // dump($allprice);exit;
        
        return view('payment',['data'=>$data,'allprice'=>$allprice]);
    }

    /*支付方式 */
    public function paytype(){

    }



}



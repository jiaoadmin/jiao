<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    /** */
    public function order(Request $Request){
        $goods_id=$Request->goods_id;
        // var_dump($goods_id);
        $allprice=$Request->allprice;
        // var_dump($allprice);
        $user_id=session('user_id');
        // var_dump($user_id);
    }



}

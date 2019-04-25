<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    //新增永久素材库
    /*
   * @content 与模型关联的数据表
   * @params
   * */
    protected $table='shop_order_detail';

    /*
     * @content 获取订单号
     * */
    public static function GetOrderInfo($ordernum)
    {
        $data = self::where('order_sn',$ordernum)->first()->toArray();
        return $data;
    }

    /*
     * @content 回复模板消息
     * */
    public static function Ordertpl($fromUsername,$orderinfo)
    {
        $num=$orderinfo['buy_numder'];
        $price=$orderinfo['goods_price'];
        $total=$num*$price;//总价
        $datajson=' {
           "touser":"'.$fromUsername.'",
           "template_id":"EmrRpKL_TLS5xQzG3ZK2MaXbZ6m_GpJ2W7lPkhvHs_U",         
           "data":{
               "welcome": {
                   "value":"欢迎使用订单查询系统！",
                   "color":"#173177"
               },
               "orderNo":{
                   "value":"'.$orderinfo['order_sn'].'",
                   "color":"#173177"
               },
               "goodsName": {
                   "value":"'.$orderinfo['goods_name'].'",
                   "color":"#173177"
               },
               "Num": {
                   "value":"'.$num.'",
                   "color":"#173177"
               },
               "price": {
                   "value":"'.$price.'",
                   "color":"#173177"
               },
               "token": {
                   "value":"'.$total.'",
                   "color":"#173177"
               },
               "status": {
                   "value":"已发货",
                   "color":"#173177"
               },
               "thanks":{
                   "value":"感谢使用！",
                   "color":"#173177"
               }
           }
       }';
        $url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".Wechar::CreatAccessToken();
        Wechar::HttpPost($url,$datajson);
    }


    /*
     * @content 与模型关联的数据id
     * @params
     * */
    protected $primaryKey='id';

    /*
     * @content 执行模型是否自动维护时间戳
     * @params
     * */
    public $timestamps=false;
}

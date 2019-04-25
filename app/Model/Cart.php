<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    /*
    * @content 与模型关联的数据表
    * @params
    * */
   protected $table='cart';

   /*
    * @content 与模型关联的数据id
    * @params
    * */
   protected $primaryKey='g_id';

   /*
    * @content 执行模型是否自动维护时间戳
    * @params
    * */
   public $timestamps=false;
}

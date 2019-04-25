<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
     /*
    * @content 与模型关联的数据表
    * @params
    * */
   protected $table='category';

   /*
    * @content 与模型关联的数据id
    * @params
    * */
   protected $primaryKey='cate_id';

   /*
    * @content 执行模型是否自动维护时间戳
    * @params
    * */
   public $timestamps=false;
}

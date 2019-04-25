<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    //新增永久素材库
    /*
   * @content 与模型关联的数据表
   * @params
   * */
    protected $table='subscribe';

    /*
     * @content 与模型关联的数据id
     * @params
     * */
    protected $primaryKey='s_id';

    /*
     * @content 执行模型是否自动维护时间戳
     * @params
     * */
    public $timestamps=false;



}

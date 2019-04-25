<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    /*
     * @content 与模型关联的数据表
     * @params
     * */
    protected $table='user';

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

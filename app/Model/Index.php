<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Index extends Model
{
    /*
     * @content 与模型关联的数据表
     * @params
     * */
    protected $table='goods';

    /*
     * @content 与模型关联的数据id
     * @params
     * */
    protected $primaryKey='goods_id';

    /*
     * @content 执行模型是否自动维护时间戳
     * @params
     * */
    public $timestamps=false;

    /*
     * @content 获取表中的最新五条数据
     * */
    public static function getdata(){
        $data = self::orderBy('goods_id','desc')->limit(5)->get();
        return $data;
    }
}

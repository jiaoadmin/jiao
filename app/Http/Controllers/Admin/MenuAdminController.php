<?php

namespace App\Http\Controllers\Admin;

use App\Model\Subscribe;
use App\Model\Wechar;
use App\Model\Menu;
use App\model\Wechat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use CURLFile;

class MenuAdminController extends Controller
{
    /*
     * @content 自定义菜单
     * */
    public function menu()
    {
        $access_token = Wechar::CreatAccessToken();
        //dd($access_token);
        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=" . $access_token;
        /*$media_id=Subscribe::orderBy('s_id','desc')->pluck('media_id');
        dd($media_id);*/
        $data = [
            'button' => [
                [
                    "type" => "view",
                    "name" => "商城",
                    "url" => "http://jqq.52lxr.cn/"
                ],
                [
                    "type" => "click",
                    "name" => "新品推荐",
                    "key" => "新品推荐"
                ],
                [
                    'name' => '我的',
                    'sub_button' => [
                        [
                            "type" => "view",
                            "name" => "我的订单",
                            "url" => "http://47.106.169.205/cart/paymentshow"
                        ],
                        [
                            "type" => "view",
                            "name" => "我的购物车",
                            "url" => "http://47.106.169.205/index/Shopcart"
                        ],
                        [
                            "type" => "view",
                            "name" => "收货地址",
                            "url" => "http://47.106.169.205/address/address"
                        ]
                    ]
                ],
               /* [
                    'name' => '我的',
                    'sub_button' => [
                        [
                            "type" => "view",
                            "name" => "小游戏",//搜索
                            "url" => "http://www.4399.com/"
                        ],
                        [
                            "type" => "click",
                            "name" => "赞一下我们",
                            "key" => "V1001_GOOD"
                        ],
                        [
                            "name" => "发送位置",
                            "type" => "location_select",
                            "key" => "rselfmenu_2_0"
                        ],
                    ]
                ]*/
            ]
        ];
        //dd($data);
        $data = json_encode($data, JSON_UNESCAPED_UNICODE);
        //dd($data);
        $re = Wechar::HttpPost($url, $data);
        //dd($re);
        $result = json_decode($re, true);
        //dd($re);
        dd($result);
        if ($result['errcode'] == 0) {
            echo "创建菜单成功";
        } else {
            die($result['errmsg']);
        }
    }

    /*
     * @content 查询自定义菜单
     * */
    public function getMenuList()
    {
        //$access_token=Wechar::CreatAccessToken();
        //$menu_url="https://api.weixin.qq.com/cgi-bin/menu/get?access_token=$access_token";
        //$re = file_get_contents($menu_url);
        $re = '{"menu":{"button":[{"type":"click","name":"今日歌曲","key":"V1001_TODAY_MUSIC","sub_button":[]},
       {"name":"菜单","sub_button":[{"type":"view","name":"搜索","url":"http:\/\/www.soso.com\/","sub_button":[]},
       {"type":"click","name":"赞一下我们","key":"V1001_GOOD","sub_button":[]}]}]}}';
        $data = json_decode($re, true)['menu']['button'];
        //print_r($data);
        $arr = [];
        $arr1 = [];
        foreach ($data as $key => $val) {
            $arr[$key]['pid'] = 4;
            $arr[$key]['name'] = $val['name'];
            $arr[$key]['type'] = isset($val['type']) ? $val['type'] : null;
            $arr[$key]['url'] = isset($val['url']) ? $val['url'] : null;
            $arr[$key]['key'] = isset($val['key']) ? $val['key'] : null;
            if (!empty($val['sub_button'])) {
                foreach ($val['sub_button'] as $k => $v) {
                    $arr1[$k]['pid'] = $key;
                    $arr1[$k]['name'] = $v['name'];
                    $arr1[$k]['type'] = isset($v['type']) ? $v['type'] : null;
                    $arr1[$k]['url'] = isset($v['url']) ? $v['url'] : null;
                    $arr1[$k]['key'] = isset($v['key']) ? $v['key'] : null;
                }
            }
        }
//        foreach ($arr as $value){
//            Menu::insert($value);
//        }
//        foreach ($arr1 as $value){
//            Menu::insert($value);
//        }

        // print_r($arr);
        //print_r($arr1);
        return redirect('/admin/menuindex');
    }

    /*
     * @content
     * */
    public function index()
    {
        $data = Menu::all();
        return view('admin.menuindex', ['menu' => $data]);
    }

    /*
     * @content 创建标签
     * */
    public function tag()
    {
        $token = Wechar::CreatAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/tags/create?access_token=" . $token;
        $data = [
            "tag" => [
                "name" => 'qq'
            ]
        ];//男id100，女id101
        $datajson = json_encode($data, JSON_UNESCAPED_UNICODE);
        $re = Wechar::HttpPost($url, $datajson);
        echo $re;
    }

    /*
     * @content 查询一创建的标签
     * */
    public function setag()
    {
        $token = Wechar::CreatAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/tags/get?access_token=" . $token;
        $re = file_get_contents($url);
        echo $re;
    }

    /*
     * @content 给用户打标签
     * */
    public function tagdo()
    {
        $token = Wechar::CreatAccessToken();
        $openidList = Wechar::GetOpenIdList();
        $url = "https://api.weixin.qq.com/cgi-bin/tags/members/batchtagging?access_token=$token";
        $data = [
            'openid_list' => $openidList,
            'tabid' => 101
        ];
        $datajson = json_encode($data);
        $re = Wechar::HttpPost($url, $datajson);
        //dd($re);
    }

    /*
     * @content 创建个性菜单
     * */
    public function menubardian()
    {
        $token = Wechar::CreatAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/menu/addconditional?access_token=" . $token;
        $data = [
            "button" => [
                [
                    "type" => "pic_weixin",
                    "name" => "相册",
                    "key" => "rselfmenu_1_2",
                ],
                [
                    "type" => "click",
                    "name" => "新品推荐",
                    "key" => "新品推荐"
                ],
                [
                    'name' => '我的',
                    'sub_button' => [
                        [
                            "type" => "view",
                            "name" => "我的订单",
                            "url" => "http://47.106.169.205/cart/paymentshow"
                        ],
                        [
                            "type" => "view",
                            "name" => "我的购物车",
                            "url" => "http://47.106.169.205/index/Shopcart"
                        ],
                        [
                            "type" => "view",
                            "name" => "收货地址",
                            "url" => "http://47.106.169.205/address/address"
                        ]
                    ]
                ],
            ],
            'matchrule' => [
                "sex" => "2",
            ]
        ];
        $datajson = json_encode($data, JSON_UNESCAPED_UNICODE);
        $re = Wechar::HttpPost($url, $datajson);
        echo $re;
    }
}
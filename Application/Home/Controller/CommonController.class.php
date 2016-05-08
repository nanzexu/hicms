<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/6 0006
 * Time: 12:31
 */
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller
{
    public $settings;
    public $good;
    function _initialize(){
        //读取系统设置
        $setting_db = M('Setting');
        $this->settings=$setting_db->select();
        $this->assign('settings',$this->settings);

        //读取产品信息
        $goodone_db=D("Goodone");
        $goodinfo=$goodone_db->select();
        foreach($goodinfo as $key=>$value){
            if($value['name']=="item_name" or $value['name']=="item_price" or $value['name']=="item_photo" or $value['name']=="form_name"){
                $this->good[$value['name']]=json_decode($value['value']);
            }
            elseif($value['name']=='remark'){
                $this->good[$value['name']]=htmlspecialchars_decode($value['value']);
            }
            else{
                $this->good[$value['name']]=$value['value'];
            }
        }
        $this->assign("good",$this->good);
        $this->assign("item_price",json_encode($this->good['item_price']));
    }
}
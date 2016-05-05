<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/4 0004
 * Time: 21:07
 */

namespace Admin\Controller;


class SettingController extends CommonController{
    public function site(){
        if(IS_POST){
            $data = I('post.');
            $this->savaSetting($data);
        }
        else{
            $this->display();
        }

    }

    function savaSetting($data){
        $setting_db = M('Setting');
        $b=false;
        $data['order_options']=json_encode($data['order_options']);

        foreach($data as $key=>$val){
            $result=$setting_db->where("name='$key'")->select();
            if($result){
                $saveinfo['value']=$val;
                $result=$setting_db->where("name='$key'")->save($saveinfo);
                if($result){
                   $b=true;
                }else {
                    $b=false;
                }
            }
            else{
                if($val){
                    $addInfo['name']=$key;
                    $addInfo['value']=$val;
                    $id=$setting_db->add($addInfo);
                    if($id){
                        $b=true;
                    }else {
                        $b=false;
                    }
                }

            }

        }
        $this->success('修改成功');


    }

}
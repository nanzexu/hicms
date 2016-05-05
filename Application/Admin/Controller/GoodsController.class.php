<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/4 0004
 * Time: 21:07
 */

namespace Admin\Controller;
class GoodsController extends CommonController{
    public function One(){
        $goodone_db=D("Goodone");
        $b=false;
        if(IS_POST){
            $data = I('post.');
            $data['item_name']=json_encode($data['item_name']);
            $data['item_price']=json_encode($data['item_price']);
            $data['item_photo']=json_encode($data['item_photo']);
            $data['form_name']=json_encode($data['form_name']);
            //dump($data);
            foreach($data as $key=>$val){
                $saveinfo['value']=$val;
                $result=$goodone_db->where("name='$key'")->select();
                if($result){
                    $saveinfo['value']=$val;
                    $result=$goodone_db->where("name='$key'")->save($saveinfo);
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
                        $id=$goodone_db->add($addInfo);
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
        else{

            $this->display();
        }
    }
    public function uploadEditer(){
        //echo $_FILES['file']['name'];
        $this->uploadMore($_FILES);

    }

}
?>
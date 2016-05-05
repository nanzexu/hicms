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
        if(IS_POST){

        }
        else{
            $goodinfo=$goodone_db->select();

            $this->display();
        }
    }
    public function uploadEditer(){
        //echo $_FILES['file']['name'];
        $this->uploadMore($_FILES);

    }

}
?>
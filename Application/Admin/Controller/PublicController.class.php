<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-12-2
 * Time: 下午7:29
 */
namespace Admin\Controller;

class PublicController extends \Think\Controller {
    public function Login(){
        if(IS_POST){

        }
        else{
            $this->display();
        }
    }
}
?>
<?php
/**
 * Created by PhpStorm.
 * User: G3-04
 * Date: 2016/1/11
 * Time: 16:33
 */
namespace Admin\Controller;
use Think\Controller;
class NewsController extends CommonController {
    public function categoryList(){
        if(IS_POST){

        }
        else{
            $this->display();
        }
    }
}
?>
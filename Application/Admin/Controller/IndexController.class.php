<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends CommonController {
    public function index(){
        $menu_db = D('Menu');
        //print_r($menu_db->getMenuTree());die();
        if(S('system_menuIndexList')){
            $data = S('system_menuIndexList');
        }else{
            $data = $menu_db->getMenuTree();
            S('system_menuIndexList', $data);
        }
        $this->assign('menuTree', $data);
        $this->display();
    }
    public function login(){
        if(IS_POST){
            if (I('get.dosubmit')){
                $admin_db = D('Admin');
                $username = I('post.username', '', 'trim') ? I('post.username', '', 'trim') : $this->error('用户名不能为空', HTTP_REFERER);
                $password = I('post.password', '', 'trim') ? I('post.password', '', 'trim') : $this->error('密码不能为空', HTTP_REFERER);
                if($admin_db->login($username, $password)){
                    $this->success('登录成功', U('Index/index'));
                }else{
                    $this->error($admin_db->error, HTTP_REFERER);
                }
            }
        }
        else{
            $this->display();
        }

    }
}
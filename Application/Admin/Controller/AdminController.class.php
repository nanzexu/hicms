<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/8 0008
 * Time: 22:44
 */

namespace Admin\Controller;


class AdminController extends CommonController
{
    public function editPwd(){
        if(IS_POST){
            $data=I('post.');
            if(empty($data['password'])){
                $this->error("请填写新密码！");
            }
            if($data['password']!=$data['repassword']){
                $this->error("确认密码错误！");
            }
            $newpwd['password']=md5($data['password']);
            $admin_db=D("Admin");
            $result = $admin_db->where(array('userid'=>$data['userid']))->save($newpwd);
            if($result){
                $this->success('修改密码成功');
            }else {
                $this->error('修改密码失败');
            }
        }
        else{
            $user['userid']=session('userid');
            $user['username']=cookie('username');
            $this->assign("user",$user);
            $this->display();
        }
    }

}
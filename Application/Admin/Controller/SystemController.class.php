<?php
/**
 * Created by PhpStorm.
 * User: 811046@qq.com
 * Date: 15-12-9
 * Time: 下午7:37
 */
namespace Admin\Controller;
use Think\Controller;
class SystemController extends CommonController{
    function menuList(){
        $menu_db = D('Menu');
        if(IS_POST){
            if(S('system_menulist')){
                $data = S('system_menulist');
            }else{
                $data = $menu_db->getTree();
                S('system_menulist', $data);
            }
            //$data = $menu_db->getTree();
            $this->ajaxReturn($data);
        }
        else{
            $currentpos = $menu_db->currentPos(I('get.menuid'));  //栏目位置
            $this->assign('currentpos', $currentpos);
            $this->display();
        }
    }
    /**
     * 删除菜单
     */
    function menuDelete($id = 0){
        if($id && IS_POST){
            $menu_db = D('Menu');
            if($menu_db->isHasChilder($id)){
                $this->error('删除失败,请先删除子菜单');
            }
            $result = $menu_db->where(array('id'=>$id))->delete();
            if($result){
                $menu_db->clearCatche();
                $this->success('删除成功');
            }else {
                $this->error('删除失败');
            }
        }else{
            $this->error('删除失败');
        }
    }
    public function getMenuSelectTree(){
        $menu_db = D('Menu');
        if(IS_POST){
            if(S('system_menulist')){
                $data = S('system_menulist');
            }else{
                $data = $menu_db->getSelectTree();
                S('system_menulist', $data);
            }
            //$data = $menu_db->getTree();
            $this->ajaxReturn($data);
        }
    }
    /**
     * 添加菜单
     */
    public function menuAdd($parentid = 0){
        if(IS_POST){
            $menu_db = D('Menu');
            $data = I('post.info');
            $data['display'] = $data['display'] ? '1' : '0';
            $id = $menu_db->add($data);
            if($id){
                $menu_db->clearCatche();
                $this->success('添加成功');
            }else {
                $this->error('添加失败');
            }
        }else{
            $this->assign('parentid', $parentid);
            $this->display('');
        }
    }
    function menuEdit($id=0){
        if(!$id) $this->error('未选择菜单');
        $menu_db = D('Menu');
        if(IS_POST){
            $data = I('post.info');
            $data['display'] = $data['display'] ? '1' : '0';
            $result = $menu_db->where(array('id'=>$id))->save($data);
            if($result){
                $menu_db->clearCatche();
                $this->success('修改成功');
            }else {
                $this->error('修改失败');
            }
        }
        else{
            if($id){
                $list=$menu_db->where(array("id"=>$id))->find();
                if($list){
                    $this->assign("info",$list);
                }
            }
            $this->display();
        }
    }
}
?>
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
    function menuEdit($id=0){
        if($id && IS_POST){

        }
        else{
            $modal=array(
                'options'=>array(
                    'title'=>'test title',
                ),
            );
            //dump($modal);
            $this->assign('modal', $modal);
            $this->display();
        }
    }
}
?>
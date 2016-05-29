<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/29 0029
 * Time: 23:19
 */

namespace Admin\Controller;


class ChannelController  extends CommonController
{
    public function index($offset=0, $limit=10, $search = array(), $sort = 'id', $order = 'desc'){
        $channel_db = D('Channel');
        if(IS_POST) {
            $where=array();
            $limit1=$offset . "," . $limit;
            $total = $channel_db->where($where)->count();

            $rows=$channel_db->where($where)->limit($limit1)->select();
            $list= array('total'=>$total, 'rows'=>$rows,'search'=>$where);
            $this->ajaxReturn($list);

        }
        else{
            $url= U('@'.$_SERVER["SERVER_NAME"]);
            $this->assign("url",$url);
            $this->display();
        }
    }
    private function get_url() {
        $sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
        $php_self = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
        $path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
        $relate_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $php_self.(isset($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : $path_info);
        return $sys_protocal.(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '').$relate_url;
    }
    public function Add(){
        $channel_db = D('Channel');
        if(IS_POST){
            $data = I('post.');
            $id = $channel_db->add($data);
            if($id){

                $this->success('添加成功');
            }else {
                $this->error('添加失败');
            }
        }
    }
    public function edit($id=0){
        if(IS_POST){
            $channel_db = D('Channel');
            $data = I('post.');
            $channel_db->where(array('id'=>$data['id']))->save($data);
            $this->success('删除成功');

        }
    }
    public function remove($id=0){
        if(IS_POST){
            $channel_db = D('Channel');

            $channel_db->where(array('id'=>$id))->delete();
            $this->success('删除成功');

        }
    }

}
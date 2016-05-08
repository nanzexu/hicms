<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/8 0008
 * Time: 20:49
 */

namespace Admin\Controller;


class OrderController extends CommonController
{
    public function index($offset=0, $limit=10, $search = array(), $sort = 'add_time', $order = 'desc'){
        if(IS_POST){
            $order="desc";
            $order_db=D('Order');
            $where=array();
            $limit1=$offset . "," . $limit;
            $total = $order_db->where($where)->count();
            $rows=$order_db->where($where)->limit($limit1)->order($sort." ".$order)->select();
            $list= array('total'=>$total, 'rows'=>$rows,'search'=>$where,'sql'=>$order_db->getLastSql());
            $this->ajaxReturn($list);
        }
        else{
            $this->display();
        }
    }
    public function Send($orderid=0){
        if(IS_POST){
            $order_db=D('Order');
            $data = I('post.');
            $data['is_sent']="1";
            $result = $order_db->where(array('id'=>$orderid))->save($data);
            if($result){
                $this->success('发货成功');
            }else {
                $this->error('发货失败');
            }
        }
        else{
            $delivery_db=D("delivery");
            $this->assign("delivery",$delivery_db->select());
            $this->display();
        }

    }
    public function Close($orderid=0){
        if(IS_POST){
            $order_db=D('Order');
            $data['is_delete']="1";
            $result = $order_db->where(array('id'=>$orderid))->save($data);
            if($result){
                $this->success('关闭成功');
            }else {
                $this->error('关闭失败');
            }
        }
    }
}
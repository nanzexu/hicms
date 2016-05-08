<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends CommonController {
    public function index(){

        $this->display();
    }
    public function Order(){
        $order_db=D("Order");
        $data = I('post.');
        $data['add_ip']=get_client_ip();
        $data['add_time']=time();
        $data['datetime']=date("Y-m-d H:i:s", time());

        if(empty($data['name'])){
            $this->error("请输入收货人姓名！");
        }
        elseif(empty($data['phone'])){
            $this->error("请输入收货人联系手机！");
        }
        elseif(empty($data['address'])){
            $this->error("请输入收货地址！");
        }
        elseif(empty($data['region']['city'])){
            $this->error("请选择地区！");
        }
        elseif(empty($data['item_name'])){
            $this->error("请选择商品参数！");
        }
        elseif(empty($data['form_name'])){
            $this->error("请选择商品参数！");
        }
        else{
            $data['region']=json_encode($data['region']);
            $id=$order_db->add($data);
            if($id){
                $this->success("提交订单成功！我们将第一时间发货！");
            }
            else{
                $this->error("提交订单失败了！");
            }
        }
    }
}

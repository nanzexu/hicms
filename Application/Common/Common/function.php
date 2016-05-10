<?php
function readSettings($name){
    $setting_db = M('Setting');
    $result=$setting_db->where("name='$name'")->find();
    return $result['value'];
}
function getDeliveryName($delivery_code){
    $delivery_db=D("Delivery");
    $where['delivery_code']=$delivery_code;
    $info=$delivery_db->where($where)->find();
    return $info['delivery_name'];
}
?>
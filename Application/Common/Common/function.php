<?php
function readSettings($name){
    $setting_db = M('Setting');
    $result=$setting_db->where("name='$name'")->find();
    return $result['value'];
}
?>
<?php
/**
 * Created by 811046@qq.com
 * User: 许正楠
 * Date: 2016/1/7
 * Time: 12:56
 */
namespace Admin\TagLib;
use Think\Template\TagLib;
defined('THINK_PATH') or exit();
class HiCms extends TagLib{
    protected $tags   =  array(
        'modal'     => array('attr'=>'id,style,options,fields','close'=>0),//bootstrap modal
    );
    public function _modal($tag) {
        $id    = !empty($tag['id']) ? $tag['id'] : CONTROLLER_NAME.'_'.ACTION_NAME.'_modal';
        $style = !empty($tag['style']) ? $tag['style'] : '';
        //default parameter
        $dataOptions = array(
            'title'=>'title',
        );
        $options = $tag['options'] ? $this->autoBuildVar($tag['options']) : 'array()';
        $fields  = $tag['fields'] ? $this->autoBuildVar($tag['fields']) : 'null';

        $parseStr="<div id='".$id."'><?php echo ".$options."['title']; ?></div>";
        $parseStr="<div class=\"modal fade\" id=\"$id\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\">";
        $parseStr.="<div class=\"modal-dialog\" role=\"document\">";
        $parseStr.="<div class=\"modal-content\">";
        $parseStr.="</div>";
        $parseStr.="</div>";
        $parseStr.="</div>";

        return $parseStr;
    }


}
?>
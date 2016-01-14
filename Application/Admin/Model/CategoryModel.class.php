<?php
/**
 * Created by 811046@qq.com.
 * User: nanze
 * Date: 2016/1/12
 * Time: 11:13
 */
namespace Admin\Model;
use Think\Model;

class CategoryModel extends Model
{
    protected $tableName = 'category';
    protected $pk = 'id';
    public $error;

    public function getTree($parentid=0){
        $field = array('catid','`catname` as `text`','url','listorder','parentid', 'ismenu');
        $order = '`listorder` ASC,`catid` DESC';
        $data = $this->field($field)->where(array('parentid'=>$parentid))->order($order)->select();

        if (is_array($data)){
            foreach ($data as &$arr){
                $nodeData=$this->getTree($arr['catid']);
                //$arr['a_attr']=array("onmouseover"=>"showEditBar(this);","onmouseout"=>"hideEditBar(this);");
                //$arr['li_attr']=array("onmouseout"=>"hideEditBar(this);");
                $arr['btns']=array(
                    array("text"=>"添加下级","evn"=>"add"),
                    array("text"=>"编辑","evn"=>"edit"),
                    array("text"=>"删除","evn"=>"del"));
                //$arr['selectable']="false";
                if($nodeData){
                    $arr['nodes']=$nodeData;


                }
                /*else{
                    $arr['icon']='fa fa-file';
                }*/

            }
        }else{
            $data = null;
        }
        return $data;
    }

    /**
     * 判断是否有子菜单
     */
    public function isHasChilder($id){
        $count=$this->where(array('parentid'=>$id))->count();
        if($count){
            return true;
        }
        else{
            return false;
        }
    }

    public function clearCatche(){
        S('news_categorylist', null);
        S('news_categoryselectlist', null);
    }
    /**
     * 菜单下拉列表
     */
    public function getSelectTree($parentid = 0){
        $field = array('`catid` as `id`','`catname` as `text`');
        $order = '`listorder` ASC,`catid` DESC';
        $data = $this->field($field)->where(array('parentid'=>$parentid,'display'=>1))->order($order)->select();
        if (is_array($data)){
            foreach ($data as &$arr){
                $arr['children'] = $this->getSelectTree($arr['id']);
            }
        }else{
            $data = array();
        }
        return $data;
    }

}
?>
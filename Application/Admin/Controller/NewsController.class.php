<?php
/**
 * Created by PhpStorm.
 * User: G3-04
 * Date: 2016/1/11
 * Time: 16:33
 */
namespace Admin\Controller;
use Think\Controller;
class NewsController extends CommonController {
    /**
     * @param int $offset
     * @param int $limit
     * @param array $search
     * @param string $sort
     * @param string $order
     */
    public function newsList($offset=0, $limit=10, $search = array(), $sort = 'listorder', $order = 'desc'){
        if(IS_POST){
            $news_db=D('News');
            $where=array();
            foreach ($search as $k=>$v){
                if(!$v) continue;
                switch ($k){
                    case 'inputtime_start':
                        if(!preg_match("/^\d{4}(-\d{2}){2}$/", $v)){
                            unset($search[$k]);
                            continue;
                        }
                        if($search['inputtime_start'] && $search['inputtime_end'] < $v) $v = $search['inputtime_end'];
                        $v = strtotime($v);
                        $where[] = "`inputtime` >= '{$v}'";
                        break;
                    case 'inputtime_end':
                        if(!preg_match("/^\d{4}(-\d{2}){2}$/", $v)){
                            unset($search[$k]);
                            continue;
                        }
                        if($search['inputtime_begin'] && $search['inputtime_begin'] > $v) $v = $search['inputtime_begin'];
                        $v = strtotime($v);
                        $where[] = "`inputtime` <= '{$v}'";
                        break;
                    default:
                        $where[$k]=array('LIKE','%'.$v.'%');
                }
            }
            //$where = implode(' and ', $where);
            $limit1=$offset . "," . $limit;
            $total = $news_db->where($where)->count();

            $rows=$news_db->where($where)->limit($limit1)->select();
            $list= array('total'=>$total, 'rows'=>$rows,'search'=>$where,'sql'=>$news_db->getLastSql());
            $this->ajaxReturn($list);
        }
        else{

            $this->display();
        }
    }
    public function categoryList(){
        if(IS_POST){
            $cate_db=D('Category');
            if(S('news_categorylist')){
                $data = S('news_categorylist');
            }else{
                $data=$cate_db->getTree();
                S('news_categorylist', $data);
            }


            $this->ajaxReturn($data);
        }
        else{

            $this->display();
        }
    }
    public function categoryDelete($id=0){
        if($id && IS_POST){
            $cate_db=D('Category');
            if($cate_db->isHasChilder($id)){
                $this->error('删除失败,请先删除子菜单');
            }
            $result = $cate_db->where(array('catid'=>$id))->delete();
            if($result){
                $cate_db->clearCatche();
                $this->success('删除成功');
            }else {
                $this->error('删除失败');
            }
        }else{
            $this->error('删除失败');
        }
    }
    public function getCategorySelectTree(){
        $cate_db=D('Category');
        if(IS_POST){
            if(S('news_categoryselectlist')){
                $data = S('news_categoryselectlist');
            }else{
                $data = $cate_db->getSelectTree();
                S('news_categoryselectlist', $data);
            }
            $this->ajaxReturn($data);
        }
    }
    public function categoryEdit($id=0){
        $cate_db=D('Category');
        if(IS_POST){

            $data = I('post.info');
            $data['display'] = $data['display'] ? '1' : '0';
            $result = $cate_db->where(array('catid'=>$id))->save($data);
            if($result){
                $cate_db->clearCatche();
                $this->success('修改成功');
            }else {
                $this->error('修改失败');
            }
        }else{
            if($id){
                $list=$cate_db->where(array("catid"=>$id))->find();
                if($list){
                    $this->assign("info",$list);
                }
            }
            $this->display();
        }
    }
    public function categoryAdd($parentid=0){

        $cate_db=D('Category');
        if(IS_POST){
            $data = I('post.info');
            $data['display'] = $data['display'] ? '1' : '0';
            $id = $cate_db->add($data);
            if($id){
                $cate_db->clearCatche();
                $this->success('添加成功');
            }else {
                $this->error('添加失败');
            }
        }else{
            $this->assign('parentid', $parentid);
            $this->display('');
        }
    }
}
?>
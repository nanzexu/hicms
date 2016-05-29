<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/30 0030
 * Time: 1:16
 */

namespace Home\Controller;


class EmptyController extends CommonController
{
    public function index(){
        //根据当前控制器名来判断要执行那个城市的操作
        $channelTitle = CONTROLLER_NAME;
        $this->Channel($channelTitle);
    }

    protected function Channel($title){
        $channel_db = D('Channel');
        $where['title']=$title;
        $channel_info=$channel_db->where($where)->find();
        $channel_info['script']=htmlspecialchars_decode($channel_info['script']);
        $this->assign('channel',$channel_info);
        $this->display('Index:index');
    }
}
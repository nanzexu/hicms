<?php
/**
 * Created by PhpStorm.
 * User: 811046@qq.com
 * Date: 15-12-7
 * Time: 下午7:51
 */
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller {
    public $settings;
    function _initialize(){
        if(IS_AJAX && IS_GET) C('DEFAULT_AJAX_RETURN', 'html');
        self::check_admin();
        self::check_priv();
        self::manage_log();

        //读取系统设置
        $setting_db = M('Setting');
        $this->settings=$setting_db->select();
        $this->assign('settings',$this->settings);

        //读取产品信息
        $goodone_db=D("Goodone");
        $goodinfo=$goodone_db->select();

        foreach($goodinfo as $key=>$value){
            if($value['name']=="item_name" or $value['name']=="item_price" or $value['name']=="item_photo" or $value['name']=="form_name"){
                $good[$value['name']]=json_decode($value['value']);
            }
            elseif($value['name']=='remark'){
                $good[$value['name']]=htmlspecialchars_decode($value['value']);
            }
            else{
                $good[$value['name']]=$value['value'];
            }
        }
        $good['remark']=str_replace(array("/r/n", "/r", "/n"), "", $good['remark']);
        $good['remark'] = str_replace(PHP_EOL, '',  $good['remark']);
        $good['remark'] = addslashes($good['remark']);
        //echo addslashes($good['remark']);die();
        $this->assign("good",$good);


        //记录上次每页显示数
        if(I('get.grid') && I('post.rows')) cookie('pagesize', I('post.rows', C('DATAGRID_PAGE_SIZE'), 'intVal'));

        $menu_db=D('Menu');
        $currentpos = $menu_db->currentPos(I('get.menuid'));  //栏目位置
        $this->assign('currentpos', $currentpos);
    }

    /**
     * 判断用户是否已经登陆
     */
    final public function check_admin() {
        if(CONTROLLER_NAME =='Index' && in_array(ACTION_NAME, array('login', 'code')) ) {
            return true;
        }
        if(!session('userid') || !session('roleid')){
            //针对iframe加载返回
            if(IS_GET && strpos(ACTION_NAME,'_iframe') !== false){
                exit('<style type="text/css">body{margin:0;padding:0}a{color:#08c;text-decoration:none}a:hover,a:focus{color:#005580;text-decoration:underline}a:focus,a:hover,a:active{outline:0}</style><div style="padding:6px;font-size:12px">请先<a target="_parent" href="'.U('Index/login').'">登录</a>后台管理</div>');
            }
            if(IS_AJAX && IS_GET){
                exit('<div style="padding:6px">请先<a href="'.U('Index/login').'">登录</a>后台管理</div>');
            }else {
                $this->error('请先登录后台管理', U('Index/login'));
            }
        }
    }

    /**
     * 权限判断
     */
    final public function check_priv() {
        if(session('roleid') == 1) return true;
        //过滤不需要权限控制的页面
        switch (CONTROLLER_NAME){
            case 'Index':
                switch (ACTION_NAME){
                    case 'index':
                    case 'login':
                    case 'code':
                    case 'logout':
                        return true;
                        break;
                }
                break;
            case 'Upload':
                return true;
                break;
            case 'Content':
                if (ACTION_NAME != 'index') return true;
                break;
        }
        if(strpos(ACTION_NAME,'public_')!==false) return true;

        $priv_db = M('admin_role_priv');
        $r = $priv_db->where(array('c'=>CONTROLLER_NAME, 'a'=>ACTION_NAME, 'roleid'=>session('roleid')))->find();
        if(!$r){
            if(IS_AJAX && IS_GET){
                exit('<div style="padding:6px">您没有权限操作该项</div>');
            }else {
                $this->error('您没有权限操作该项');
            }
        }
    }

    /**
     * 记录日志
     */
    final private function manage_log(){
        //判断是否记录
        if(C('SAVE_LOG_OPEN')){
            $action = ACTION_NAME;
            if($action == '' || strchr($action,'public') || (CONTROLLER_NAME =='Index' && in_array($action, array('login','code'))) ||  CONTROLLER_NAME =='Upload') {
                return false;
            }else {
                $ip = get_client_ip();
                $username = cookie('username');
                $userid = session('userid');
                $time = date('Y-m-d H-i-s');
                $data = array('GET'=>$_GET);
                if(IS_POST) $data['POST'] = $_POST;
                $data_json = json_encode($data);
                $log_db = M('log');
                $log_db->add(array('username'=>$username,'userid'=>$userid,'controller'=>CONTROLLER_NAME,'action'=>ACTION_NAME, 'querystring'=>$data_json,'time'=>$time,'ip'=>$ip));
            }
        }
    }

    /**
     * 空操作，用于输出404页面
     */
    public function _empty(){
        //针对后台ajax请求特殊处理
        if(!IS_AJAX) send_http_status(404);
        if (IS_AJAX && IS_POST){
            $data = array('info'=>'请求地址不存在或已经删除', 'status'=>0, 'total'=>0, 'rows'=>array());
            $this->ajaxReturn($data);
        }else{
            $this->display('Common:404');
        }
    }

    //文件上传
    public function uploadMore($file){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
        $upload->savePath  =     ''; // 设置附件上传（子）目录
        $upload->saveName =array('uniqid','');
        // 上传文件
        $info   =   $upload->upload($file);
        if(!$info) {// 上传错误提示错误信息
            $this->ajaxReturn(array("status"=>"0","msg"=>$upload->getError()));

        }else{// 上传成功
            $this->ajaxReturn($info['file']);
        }

    }
    public function uploadOne(){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
        $upload->savePath  =     ''; // 设置附件上传（子）目录
        $upload->saveName = array('uniqid','');
        // 上传文件
        $info   =   $upload->upload();
        //dump($info);
        //dump(I('post.fileElementId'));

        if(!$info) {// 上传错误提示错误信息
            $this->ajaxReturn(array("status"=>0,"msg"=>$upload->getError()));

        }else{// 上传成功
            //dump($info[I('post.fileElementId')]);
            $this->ajaxReturn($info[I('post.fileElementId')]);
        }

    }


}
?>
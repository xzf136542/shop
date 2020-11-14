<?php
namespace app\index\controller;

use think\Controller;
use think\Request;

class Common extends Controller
{
    public $is_check_login =false;
    public function __construct()
    {
        parent::__construct();
        $category =  model('category') -> getTree();
        $this -> assign('category',$category);
            if(!session('user') && $this -> is_check_login){
            $this -> error('没有登录','user/login');
        }
    }

}
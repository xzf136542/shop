<?php
namespace app\index\controller;

use think\Controller;
use think\Request;

class Order extends Common
{
    public $is_check_login =true;
    public function index(){
        $data = model('Order') -> showIndex();
//                dump($data);exit();
        $this -> assign('data',$data);
        return $this -> fetch();
    }
}
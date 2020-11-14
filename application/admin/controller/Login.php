<?php
namespace app\admin\controller;

use think\Controller;
use think\Image;
use think\Request;

class Login extends Controller
{
    public function logout(){
        cookie('user_info',null);
        $this -> success('ok','login/login');
    }
    public function dologin(){
        $postdata = input();
        $model = model('Admin');
        $res = $model  -> check($postdata);
        if($res === false){
            return json(['code' =>0,'msg' => 'error','data' =>$model -> getError()]);
        }
        return  json(['code' =>1,'msg' => 'ok']);
    }
    public function captcha(){
        $obj = new \think\captcha\Captcha(['length'=>3,'codeSet' =>'12345']);
        return $obj -> entry();
    }
    public function login(){
        return $this -> fetch();
    }
}
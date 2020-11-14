<?php
namespace app\admin\model;

use think\Model;
use think\Request;

class Admin extends Model
{
    public function add($postdata){
        $map = [
          'username' => $postdata['username']
        ];
        $info = $this -> get($map);
        if($info){
            $this -> error = '账号已存在';
            return false;
        }
        if(strlen($postdata['username'])<5){
            $this -> error = '账号长度设置为5-10个字符';
            return false;
        }
        if(strlen($postdata['password'])<6){
            $this -> error = '密码长度设置为6-10个字符';
            return false;
        }
        $postdata['password'] = md5($postdata['password']);
        $this -> isUpdate(false) -> save($postdata);
    }
    public function check($postdata){
        $obj = new \think\captcha\Captcha();
        if(!$obj -> check($postdata['captcha'])){
            $this -> error = '验证码错误';
            return false;
        }
        $map = [
            'username' =>$postdata['username'],
            ];
        $user_info = $this -> get($map);
        if(!$user_info){
            $this -> error = '用户名不存在';
            return false;
        }

        if($user_info -> getAttr('password') != md5($postdata['password'])){
            $this -> error = '密码错误';
            return false;
        }
        if($postdata['remember'] ==1){
            $expire = 3600*7;
        }
        //保存登录状态
        cookie('user_info',$user_info -> toArray(),$expire);
    }
}
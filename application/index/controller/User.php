<?php
namespace app\index\controller;

use think\Request;

class User extends Common
{

    public function sendSms(){
       $phone = input('phone');
       if(!$phone){
           return json(['code' => 1,'msg' => '手机号码要填写']);
       }
       $sms_captcha = rand(1000,9999);
       $res = send_sms($phone,[$sms_captcha,10]);
       if($res ===false){
            return json(['code' => 1,'msg' => '短信发送过于繁忙']);
       }
        session('sms_captcha',['sms_captcha'=>$sms_captcha,'time' =>time()]);
       return json(['code' =>0,'msg'=>'ok']);
    }
    public function logout(){
        session('user',null);
        $this -> success('ok','index/index');
    }
    public function login(Request $request){
        if($request -> isGet()){
            return $this -> fetch();
        }
        $user_info = db('User') -> where('username',input('username')) -> whereOr('phone',input('username'))
            -> whereOr('email',input('username'))-> find();
        if(!$user_info){
            $this -> error('用户名不存在');
        }

        $password = input('password');
        $salt = $user_info['salt'];
        if($user_info['password'] !== md5(md5($password.$salt))){
            $this -> error('密码错误');
        }
        if($user_info['status'] ==0){
            $this -> error('用户未激活');
        }
        session('user',$user_info);
        model('Cart') -> cookie2db();
        $this -> success('ok','index/index');
    }
    public function captcha(){
        $obj  = new \think\captcha\Captcha(['length' => 3,'codeSet' =>'123456']);
        return $obj -> entry();
    }
    public function regist(Request $request){
        if($request -> isGet()){
            return $this -> fetch();
        }
        $captcha = new \think\captcha\Captcha();
        if(!$captcha -> check(input('captcha'))){
            $this-> error('验证码错误');
        }
        $list['username'] =input('username');
        $session = session('sms_captcha');
        if (!$session || $session['sms_captcha'] !=input('sms_captcha')){
            $this -> error('验证码错误');
        }
        if(time() - $session['time'] >600){
            session('sms_cpatcha',null);
            $this -> error('验证码过期');
        }
        //避免重复使用
        session('sms_cpatcha',null);
        $list['salt'] = mt_rand(10000,99999);
        if($user_info= db('User') -> where('username',input('username')) -> find()){
            $this -> error('用户名已存在');
        }
        $list['phone'] =input('phone');
        $list['password'] =md5(md5(input('password') .$list['salt']));
        $list['status'] =1;
        $res = db('user') -> insert($list);
        if(!$res){
            $this -> error('创建错误');
        }
        $this -> success('ok','user/login');
    }
    public function active(){
        $key = input('key','');
        $user_id = cache($key);
        if(!$user_id){
            return '非法请求';
        }
        db('user') -> where('id',$user_id) ->setField('status',1);
        cache($key,null);
    }
    public function registEmail(Request $request){
        if($request -> isGet()){
            return $this -> fetch();
        }

        $list['username'] =input('username');
        $list['email'] =input('email');
        if(db('user') -> find('email',input('email'))){
            $this -> error('邮箱重复');
        }

        if($user_info= db('User') -> where('username',input('username')) -> find()){
            $this -> error('用户名已存在');
        }
        $list['salt'] = mt_rand(10000,99999);
        $list['password'] =md5(md5(input('password') .$list['salt']));

        $res = db('user') -> insert($list);
        $key = uniqid();
        cache($key,db('user') ->  getLastInsId());
        $url = url('index/user/active','key=' .$key,true,true);
        $body="<a href='$url' style='font-size: 28px'>您好,邮箱注册登录点击</a>";
        send_email($list['email'],$body,'商城管理员');
        $this -> success('ok','user/login');

    }
}
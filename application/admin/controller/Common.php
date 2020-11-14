<?php
namespace app\admin\controller;

use think\Controller;
use think\Request;

class Common extends Controller{
    public  $_user = [];
    public function __construct()
    {
        parent::__construct();
        $user_info =cookie('user_info');
        if(!$user_info){
            $this -> error('未登录','login/login');
        }
        $this -> _user = $user_info;
        if($this->_user['role_id'] ==1){
            $privileges = db('privilege') -> select();
        }else{
            $map = [
                'id' => $this -> _user['role_id']
            ];
            $role_info = db('role') -> where($map) -> find();

            $privileges = db('privilege') -> where('id','in',$role_info['p_ids']) -> select();
        }
        foreach ($privileges as $key => $value){
            if($value['is_show'] == 1){
                $this -> _user['menu'][] = $value;
            }
            $this -> _user['privileges'][] = strtolower($value['controller_name'] . '/' .$value['action_name']);
        }
        if($this ->_user['role_id'] !=1){
            $this -> _user['privileges'][] ='index/index';
            $this -> _user['privileges'][] ='index/top';
            $this -> _user['privileges'][] ='index/main';
            $this -> _user['privileges'][] ='index/menu';
            $action = strtolower(request() -> controller() .'/'.request() -> action());
            if(!in_array($action,$this->_user['privileges'])){
                if(request() -> isAjax()){
                    return json(['code' =>0,'error'=>'没有权限']);exit();
                }
                $this -> error('没有权限','index/index');
            }
        }
    }
}
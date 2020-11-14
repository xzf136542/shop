<?php
namespace app\admin\controller;


use think\Db;
use think\Request;

class Role extends Common
{
    public function disfetch(Request $request)
    {
        if($request -> isGet()){
            $role_info = db('role') -> where('id',input('id/d')) -> find();
            $this -> assign('roleInfo',$role_info);
            $data = db('privilege') -> select();
            $this -> assign('data',$data);
            return $this -> fetch();
        }
        $rules = input('rules/a',[]);
        $rules = implode(',',$rules);
        db('Role') -> where('id',input('id/d'))-> setField('p_ids',$rules);
        $this -> success('ok','index');
    }

    public function remove(){
        $id = input('id/d');
        db('role') -> delete($id);
        $this -> success('ok','index');
    }
    public function add(Request $request){
        if($request -> isGet()){
            return $this -> fetch();
        }
        db('role') -> insert(input());
        $this -> success('ok','index');
    }
    public function index(){
        $data  = db('role') -> select();
        $this -> assign('data',$data);
        return $this -> fetch();
    }
}
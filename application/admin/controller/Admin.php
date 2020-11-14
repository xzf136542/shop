<?php
namespace app\admin\controller;


use think\Request;

class Admin extends Common
{
    public function index(){
        $data = db('admin') -> field('a.*,b.role_name') -> join('role b','a.role_id=b.id','left') -> alias('a') ->
            select();
        return $this -> fetch('',['data' =>$data]);
    }
    public function add(Request $request){
        if($request -> isGet()){
            $roles = cache('roles');
            if(!$roles){
                $roles = db('role') -> select();
                cache('roles',$roles,3600*24);
            }
            $this -> assign('roles',$roles);
            return $this -> fetch();
        }
        $postdata =input();
        $model = model('Admin');
        $res = $model -> add($postdata);
        if($res ===false){
            $this ->error($model -> getError());
        }
        $this ->success('ok','index');
    }
}
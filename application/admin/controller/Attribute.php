<?php
namespace app\admin\controller;


use think\Request;

class Attribute extends Common
{
    public function edit(Request $request){
        if($request -> isGet()){
            $type = db('Type') -> select();
            $this-> assign('type',$type);
            $data = db('Attribute') -> find(input('id/d'));
            $this -> assign('data',$data);
            return $this ->fetch();
        }

        db('Attribute') -> update(input());
        $this -> success('ok','index');
    }
    public function remove(){
       db('Attribute') -> delete(input('id/d'));
       $this -> success('ok','index');
    }
    public function index(){
        $data = model('Attribute') -> showIndex();
        $this -> assign('data',$data);
        return $this -> fetch();
    }
    public function add(Request $request){
        if($request -> isGet()){
            return $this -> fetch('',['data'=>model('Type') -> all()]);
        }
       $model = model('Attribute');
        $res = $model -> add(input());
        if($res ===false){
            $this -> error($model -> getError());
        }
        $this -> success('ok','index');
    }
}
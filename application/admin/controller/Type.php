<?php
namespace app\admin\controller;


use think\Request;

class Type extends Common
{
    public function edit(Request  $request){
        if($request ->isGet()){
            $data = db('Type') -> where(['id'=>input('id/d')]) -> find();
            return $this ->fetch('',['data'=>$data]);
        }
        $postdata = input();
        db('Type') -> update($postdata);
        $this -> success('ok','index');
    }
    public function remove(){
        db('Type') -> delete(input('id/d'));
        $this -> success('ok','index');
    }
    public function index(){
        $data = model('Type') -> all();
        return $this -> fetch('index',['data' =>$data]);
    }
    public function add(Request $request){
        if($request -> isGet()){
            return $this ->fetch();
        }
        $postadata = input();
        $model = model('Type');
        $res = $model -> add($postadata);
        if($res ===false){
            $this -> error($model -> getError());
        }
        $this ->success('ok','index');
    }
}
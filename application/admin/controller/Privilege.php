<?php
namespace app\admin\controller;


use think\Request;

class Privilege extends Common
{
    public function remove(){
        if(db('privilege') ->where(['parent_id' =>input('id/d')])-> find()){
            $this -> error('存在子权限不能删除','index');
        }
        db('privilege') -> where(['id'=>input('id/d')]) -> delete();
        $this -> success('ok','index');
    }
    public function edit(Request $request){
        if($request -> isGet()){
            $map = [
                'id' => input('id/d',0)
            ];
            $info = db('Privilege') -> where($map) -> find();
            $privilege = model('Privilege') -> getCateTree();
            $this -> assign('privilege',$privilege);
            $this -> assign('info',$info);
            return $this -> fetch();
        }

        db('Privilege') -> update(input());
        $this -> success('ok','index');

    }
    public function index(){
        $list = model('privilege') -> getCateTree();
        return $this -> fetch('',['list' => $list]);
    }
    public function add(Request $request)
    {
        if ($request->isGet()) {
            $privilege = model('Privilege') -> getCateTree();
            $this -> assign('privilege',$privilege);
            return $this->fetch();
        }
        db('privilege')->insert(input());
        $this->success('ok', 'index');
    }


}
<?php
namespace app\admin\controller;


use think\Request;

class Category extends Common
{
    public function edit(Request $request)
    {
        if($request -> isGet()){
            $id  =input('id/d',0);
            $info = model('Category') -> get($id);
            $this -> assign('info',$info);
            $data = model('Category') -> getCateTree();
            $this -> assign('data',$data);
            return $this -> fetch();
        }
        $postdata = input();
        $model = model('Category');
        $res = $model -> edit($postdata);
        if($res ===false){
            $this -> error($model -> getError());
        }
        $this -> success('ok','index');
    }

    public function remove()
    {
        $id  =input('id/d',0);
        $model = model('Category');
        $res = $model -> remove($id);
        if($res === false){
            $this -> error($model -> getError());
        }
        $this -> success('ok','index');
    }

    public function index()
    {
        $data = model('Category') -> getCateTree();
        $this -> assign('data',$data);
        return $this -> fetch();
    }

    public function add(Request $request){
        if($request -> isGet()){
            $data = model('Category') -> getCateTree();
            $this -> assign('data',$data);
            return $this -> fetch();
        }
        $postdata = input();
        $model = model('category');
        $res  =$model -> add($postdata);
        if($res ===false){
            $this ->error($model -> getError());
        }
        $this -> success('ok','index');
    }
}
<?php
namespace app\index\controller;

use think\Controller;
use think\Request;

class Cart extends Common
{
    public function changeNumber(){
       $postdata = input();
       $res = model('Cart') ->changeNumber($postdata);
       if($res ===false){
           return json(['code' =>0,'msg' =>model('Cart') -> getError()]);
       }
       return  json(['code' =>1,'msg' =>'ok']);
    }
    public function remove(){
        $postdata = input('post');
        model('Cart') -> del($postdata);
        $this -> success('ok','index');
    }
    public function index(){
        $data = model('Cart') -> showIndex();
        $total = model('cart') -> getTotal($data);

        $this -> assign('total',$total);
        $this -> assign('data',$data);
        return $this -> fetch();
    }
    public function addCart(){
        $goods_id = input('goods_id/d');
        $goods_attr_ids = input('goods_attr_ids/a');
        $goods_attr_ids = implode(',',$goods_attr_ids);
        $goods_count = input('goods_count');
        $model = model('Cart');
        $res = $model -> addCart($goods_id,$goods_attr_ids,$goods_count);
        if($res === false){
            $this -> error($model -> getError());
        }
        $this -> success('ok','index/index');
    }
}
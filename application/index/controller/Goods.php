<?php
namespace app\index\controller;

use think\Controller;
use think\Request;

class Goods extends Common
{
    public function detail(Request $request)
    {
        $model = model('Goods');
        $goods = $model -> GetGoodsInfo(input('id/d'));
        if(!$goods){
           $this -> redirect('index/index/index');
        }
        $this -> assign('goods',$goods);
        return $this -> fetch();
    }
}
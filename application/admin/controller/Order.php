<?php
namespace app\admin\controller;

use think\Controller;
use think\Image;
use think\Request;

class Order extends Controller
{
    public function send(Request $request){
        $model = model('Order');
        $order_id =input('id/d');
        if($request -> isGet()){
           $goods_info = $model -> getGoodsInfo($order_id);
//           dump($goods_info);
           $this -> assign('goods_info',$goods_info);
           return $this -> fetch();
        }
        $postdata =input();
        $postdata['status'] = 2;
        db('Order') ->update($postdata);
        $this -> success('ok','index');
    }
    public function index(Request $request){
            $data = db('Order') ->alias('a') -> join('user b','a.user_id=b.id','left') ->field('a.*,b.username')-> select();
            $this -> assign('data',$data);
            return $this -> fetch();
    }
}
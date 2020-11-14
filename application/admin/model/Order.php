<?php
namespace app\admin\model;

use think\Model;

class Order extends Model
{
    public function getGoodsInfo($order_id){
        $order_info = db('order') -> find($order_id);
        $order_info['order_detail'] = db('order_detail') -> where('order_id',$order_id) -> select();
        foreach($order_info['order_detail'] as $key => $value){
            $order_info['order_detail'][$key]['goods_info'] = db('goods') ->  find($value['goods_id']);
            $order_info['order_detail'][$key]['attrs'] = db('goods_attr') -> alias('a') -> field('a.attr_value,b.attr_name') ->
                join('attribute b','a.attr_id=b.id','left') -> where('a.id','in',$value['goods_attr_ids']) -> select();
        }
        return $order_info;
    }
}
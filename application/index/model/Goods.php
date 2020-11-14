<?php
namespace  app\index\model;

use think\Model;

class Goods extends Model
{
    public function decGoodsNumber($goods_id,$goods_count,$goods_attr_ids){

       db('goods') -> where('id',$goods_id) ->setDec('goods_number',$goods_count);
}
    public function checkGoodsNumber($goods_id,$goods_attr_ids,$goods_count){
        $goods = $this -> getQueryObj()  -> find($goods_id);
        if(!$goods || $goods_count> $goods['goods_number']){
            return false;
        }
        return  true;
    }
    public function GetGoodsInfo($goods_id){
        $goods = $this -> getQueryObj()  -> find($goods_id);
        if(!$goods){
            return  false;
        }
        $goods['imgs'] =db('goods_img') -> field('goods_img,goods_thumb')  -> where('goods_id',$goods_id) -> select();
        $attrs = db('GoodsAttr') -> where('goods_id',$goods_id) -> field('a.*,b.attr_name,b.attr_type') -> alias('a') ->
        join('attribute b','a.attr_id=b.id','left') -> select();
        $goods['single'] =  $goods['unique'] =[];
        foreach ($attrs as $key => $value){
            if($value['attr_type'] ==1){
                $goods['unique'][] = $value;
            }else{
                //因为单选属性的attr_id是同一个所以使用他做下标,
                $goods['single'][$value['attr_id']][] =$value;
            }
        }
        return $goods;
    }
    public function getQueryObj(){
        return db('Goods');
    }
    public function getRecGoods($field){
        $map = [
            $field => 1,
            'is_del' => 0
        ];

      return  $this -> getQueryObj() -> where($map) ->limit(5)-> select();
    }
}
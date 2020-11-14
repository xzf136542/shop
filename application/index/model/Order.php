<?php
namespace  app\index\model;

use think\Db;
use think\Exception;
use think\Model;

class Order extends Model
{
    public function showIndex(){
        $user_id = model('User') -> getUserId();
        return db('order')-> where('user_id',$user_id) -> select();
    }
    public function order($postdata){
        Db::startTrans();
        try {
            //1检查库存
            $cart_list = model('Cart') -> showIndex();
            foreach ($cart_list as $value){
                $res = model('Goods') -> checkGoodsNumber($value['goods_id'],$value['goods_attr_ids'],$value['goods_count']);
                if($res === false){
                    $this -> error = '库存不足';
                    return false;
                }
            }
            //2写入订单主表
            $postdata['money'] =model('Cart') -> getTotal($cart_list);
            $postdata['user_id'] =model('User') -> getUserId();
            $postdata['order_sn'] = date('YmdHis').rand(10000,99999);
            $postdata['addtime'] =time();
            $user_info= db('User') -> find($postdata['user_id']);
            if(isset($postdata['is_use_score'])){
                //判断积分是否够用
               $total_score = $postdata['money'] *100;
               if($total_score  <= $user_info['score'] ){
                   $postdata['score'] =$total_score;
                    $postdata['need_pay_money'] =0;
               }else{
                   $postdata['score'] = $user_info['score'];
                   $postdata['need_pay_money'] = $postdata['money'] - $user_info['score']/100;
               }
               db('user') ->where('id',$postdata['user_id']) -> setDec('score',$postdata['score']);
                $sign_log=[
                    'user_id' =>$postdata['user_id'],
                    'type' =>1,
                    'before_score' => $user_info['score'],
                    'after_score' =>$user_info['score'] -$postdata['score'],
                    'score' => $postdata['score'],
                    'remake' => '购物使用了'.$postdata['score'].'积分',
                    'way' =>2,
                    'addtime' =>time()
                ];
                db('sign_log') -> insert($sign_log);
            }else{
                $postdata['score'] =0;
                $postdata['need_pay_money'] =$postdata['money'];
            }


            $this -> isUpdate(false) -> allowField(true) ->save($postdata);
            //3写入订单详情表
            $order_id = $this -> getLastInsID();
            $order_detail=[];
            foreach ($cart_list as $key =>$value){
                $order_detail[] =[
                    'goods_id' => $value['goods_id'],
                    'order_id' =>$order_id,
                    'goods_count' =>$value['goods_count'],
                    'goods_attr_ids' =>$value['goods_attr_ids']
                ];
                model('Goods') -> decGoodsNumber($value['goods_id'],$value['goods_count'],$value['goods_attr_ids']);
            }
            db('order_detail') -> insertAll($order_detail);
            //4减少库存
            //5清空购物车
            model('Cart') ->clear();
            //返回订单主表数据
            return $postdata;
            Db::commit();
        }catch (Exception $e){
            $this  -> error ='错误';
            Db::rollback();
        }

    }
}
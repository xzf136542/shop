<?php
namespace  app\index\model;

use think\Model;

class Cart extends Model
{
    public  function clear(){
        $user_id = model('User') -> getUserId();
        if($user_id){
            $this -> where('user_id',$user_id) -> delete();
        }else{
            cookie('cart_list',null);
        }

    }
    //数据转移
    public function cookie2db(){
        $user_id = model('user') -> getUserId();
        if(!$user_id){
            return false;
        }
        $cart_list = cookie('cart_list')?cookie('cart_list'):[];
        foreach ($cart_list as $key => $value){
            $tmp = explode('-',$key);
            $map = [
                'goods_id' =>$tmp[0],
                'goods_attr_ids' =>$tmp[1],
                'user_id' => $user_id
            ];
           if($this -> where($map) -> find()){
               $this -> where($map) -> setField('goods_count',$value);
           }else{
               $map['goods_count'] = $value;
               $this ->isUpdate(false) -> save($map);
           }
        }
        cookie('cart_list',null);
    }
    public function changeNumber($postdata){
        $user_id = model('user') -> getUserId();
        if($user_id){
            $map=[
                'goods_id' =>$postdata['goods_id'],
                'user_id' =>$user_id,
                'goods_attr_ids' =>$postdata['goods_attr_ids'],
            ];
            db('Cart') -> where($map) -> setField('goods_count',$postdata['goods_count']);
        }else{
            $cart_list = cookie('cart_list')?cookie('cart_list'):[];
            $key = $postdata['goods_id'] .'-' . $postdata['goods_attr_ids'];
            $cart_list[$key] = $postdata['goods_count'];
            cookie('cart_list',$cart_list,3600*24*7);
        }
    }
    public function del($postdata){
        $user_id = model('user') -> getUserId();
        if($user_id){
            //登录
            $postdata['user_id'] =$user_id;
//            dump($postdata);exit();
            db('Cart') -> where($postdata) -> delete();
        }else{
            //未登录
            $cart_list = cookie('cart_list')?cookie('cart_list'):[];
            $key = $postdata['goods_id'] .'-' . $postdata['goods_attr_ids'];
            unset($cart_list[$key]);
            cookie('cart_list',$cart_list,3600*24*7);
        }

    }
    public function getTotal($data){
        $total = 0;
        foreach ($data as $value){
            $total += $value['goods_count'] * $value['goods_info']['shop_price'];
        }
        return $total;
    }
    public function showIndex(){
        $user_id = model('user') -> getUserId();
        if($user_id){
            //登录
            $list = [];
            $list = db('cart')->where('user_id',$user_id) -> select();
        }else{
            //未登录
           $cart_list = cookie('cart_list')?cookie('cart_list'):[];
           $list = [];
           foreach ($cart_list as $key => $value){
               $tmp = explode('-',$key);
               $list[]=[
                    'goods_id' =>$tmp[0],
                   'goods_count' => $value,
                   'goods_attr_ids' =>$tmp[1]

               ];
           }
        }

        foreach ($list as $key => $value){
            $list[$key]['goods_info'] = db('Goods') -> where('id',$value['goods_id']) -> find();
            $list[$key]['attrs'] =db('GoodsAttr') -> where('a.id','in',$value['goods_attr_ids']) -> alias('a') ->field('a.attr_value,b.attr_name')
                -> join('attribute b','a.attr_id=b.id','left') -> select();
        }


        return $list;
    }
    public function addCart($goods_id,$goods_attr_ids,$goods_count)
    {
        if(model('Goods') -> checkGoodsNumber($goods_id,$goods_attr_ids,$goods_count) ===false){
            $this -> error = '库存不足';
            return false;
        }
        $user_id = model('user') -> getUserId();
        if($user_id){
            //已经登录
            $map =[
                'goods_id' =>$goods_id,
                'goods_attr_ids' => $goods_attr_ids,
                'user_id' =>$user_id
            ];
            if($this -> where($map) -> find()){
                $this -> where($map) -> setInc('goods_count',$goods_count);
            }else{
                $map['goods_count'] = $goods_count;
                $this -> isUpdate(false) -> save($map);
            }
        }else{
            //没有登录
            $cart_list = cookie('cart_list')?cookie('cart_list'):[];
            $key = $goods_id . '-' .$goods_attr_ids;
            if(array_key_exists($key,$cart_list)){
                $cart_list[$key] += $goods_count;
            }else{
                $cart_list[$key] =$goods_count;
            }
            cookie('cart_list',$cart_list,3600*24*7);
        }

    }
}
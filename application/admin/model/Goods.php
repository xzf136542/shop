<?php
namespace app\admin\model;

use think\Model;
use think\db;

class Goods extends Model
{

    public function recycle(){
        $where = ['is_del' =>1];
        $keyword = input('keyword');
        if($keyword){
            $where['goods_name'] =['like','%' . $keyword.'%'];
        }

        $intro_type = input('intro_type');
        if($intro_type){
            $where[$intro_type] =1;
        }
        $cate_id = input('cate_id');
        if($cate_id){
            $cate_ids =[$cate_id];
            $son = model('category') -> getCateTree($cate_id,true);
            foreach ($son as $value){
                $cate_ids[] = $value -> id;
            }
            $where['cate_id'] = ['in',$cate_ids];
        }
        $data = $this ->where($where) ->  paginate(2,false,['query' =>input()]);


        return $data;
    }
    public function edit($postdata){
        $postdata['is_hot'] = isset($postdata['is_hot'])?isset($postdata['is_hot']):0;
        $postdata['is_new'] = isset($postdata['is_new'])?isset($postdata['is_new']):0;
        $postdata['is_rec'] = isset($postdata['is_rec'])?isset($postdata['is_rec']):0;
        $this -> isUpdate(true)->allowField(true) -> save($postdata);
    }
    public function showIndex(){
        $where = ['is_del' =>0];
        $keyword = input('keyword');
        if($keyword){
            $where['goods_name'] =['like','%' . $keyword.'%'];
        }

        $intro_type = input('intro_type');
        if($intro_type){
            $where[$intro_type] =1;
        }
        $cate_id = input('cate_id');
        if($cate_id){
            $cate_ids =[$cate_id];
            $son = model('category') -> getCateTree($cate_id,true);
           foreach ($son as $value){
               $cate_ids[] = $value -> id;
           }
            $where['cate_id'] = ['in',$cate_ids];
        }
        $data = $this ->where($where) ->  paginate(1,false,['query' =>input()]);


        return $data;
    }
    public function add($postdata){
        $postdata['add_time'] =time();
        Db::startTrans();
        try {
            $this -> isUpdate(false)->allowField(true) -> save($postdata);
            $goods_id = $this ->getLastInsID();
            $attr_ids = input('attr_ids/a',[]);
            $attr_values = input('attr_values/a',[]);
            model('GoodsAttr') -> addAll($goods_id,$attr_ids,$attr_values);
            model('goodsImg') -> uploadGoodsImg($goods_id);
            Db::commit();
        }catch (\Exception $e){
            Db::rollback();
            $this -> error = '数据写入错误';
            return false;
        }

    }

    public function changeStatus($goods_id,$field)
    {
        $goods_info = $this -> get($goods_id);
        $status = $goods_info -> getAttr($field)?0:1;
        $this -> where('id',$goods_id) -> setField($field,$status);
        return $status;
    }
}
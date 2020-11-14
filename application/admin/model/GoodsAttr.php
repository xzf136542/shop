<?php
namespace app\admin\model;

use think\Model;

class GoodsAttr extends Model
{
    public function addAll($goods_id,$attr_ids,$attr_values){
        $list = [];
        $tmp=[];
        foreach ($attr_ids as $key => $value){
            if(in_array($value .'-'. $attr_values[$key],$tmp)){
                continue;
            }
            $tmp[] = $value .'-'. $attr_values[$key];
            $list[] = [
                'goods_id' => $goods_id,
                'attr_id' =>$value,
                'attr_value' =>$attr_values[$key]
            ];
        }
        $this -> saveAll($list);
    }
}
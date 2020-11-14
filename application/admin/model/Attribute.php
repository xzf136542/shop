<?php
namespace app\admin\model;

use think\Model;

class Attribute extends Model
{
    public function getAttrs($type_id){
        $list  = db('attribute') -> where('type_id',$type_id) -> select();
        foreach ($list as $key => $value){
            if($value['attr_input_type'] ==2){
                $list[$key]['attr_values'] = explode(',',$value['attr_values']);
            }
        }
        return $list;
    }
    public function showIndex(){
        $data = db('Attribute') -> alias('a') -> field('a.*,b.type_name') -> join('shop_type b',
        'a.type_id = b.id','left') -> select();
        return $data;
    }
    public function add($postdata){
        if($postdata['attr_type'] ==1){
            unset($postdata['attr_values']);
        }else{
            if(!$postdata['attr_values']){
                $this -> error  = '属性值需要设置';
                return false;
            }

        }
       $this -> allowField(true) -> isUpdate(false) -> save($postdata);
    }
}
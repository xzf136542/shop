<?php
namespace app\admin\model;

use think\Model;

class Category extends Model
{
    public function edit($postdata)
    {
        if($postdata['parent_id'] ==$postdata['id']){
            $this -> error ='不能设置自己为父分类';
            return false;
        }
        $data = $this -> getCateTree($postdata['id']);
        foreach ($data as $value) {
            if($postdata['parent_id'] == $value ->getAttr('id')){
                $this -> error ='不能设置子分类为父分类';
                return false;
            }
        }

        $this -> isUpdate(true) -> save($postdata);
    }

    public function remove($id)
    {
        if($this -> get(['parent_id' =>$id])){
            $this -> error = '存在子分类不能删除';
            return false;
        }
        $this -> destroy($id);
    }

    public function getCateTree($id =0,$is_clear=false)
    {
        $data = $this -> all();
        $data = get_tree($data,$id,0,$is_clear);
        return $data;
    }

    public function add($postdata)
    {
        $this -> isUpdate(false) -> save($postdata);
    }
}
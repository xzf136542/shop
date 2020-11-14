<?php
namespace app\admin\model;

use think\Model;

class Privilege extends Model
{
    public function getCateTree($id =0,$is_clear=false)
    {
        $data = $this -> all();
        $data = get_tree($data,$id,0,$is_clear);
        return $data;
    }
}
<?php
namespace app\admin\model;

use think\Model;

class Type extends Model
{
    public function showIndex(){
        return $this -> all();
    }
    public function add($postdata){
        $this -> isUpdate(false) -> allowField(true) -> save($postdata);
    }
}
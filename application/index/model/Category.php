<?php
namespace  app\index\model;

use think\Model;

class Category extends Model
{
    public function getTree()
    {
        $category = cache('category');
        if(!$category){
            $category = $this -> all();
            cache('category',$category);
        }

        return $category;
    }
}
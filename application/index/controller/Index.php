<?php
namespace app\index\controller;

use think\Controller;

class Index extends Common {
    public function index(){
        $model = model('Goods');
        $data['hot'] = $model -> getRecGoods('is_hot');
        $data['rec'] = $model -> getRecGoods('is_rec');
        $data['new'] = $model -> getRecGoods('is_new');
        $this -> assign('data',$data);
        $this -> assign('is_index',1);
        return $this -> fetch();
    }
}
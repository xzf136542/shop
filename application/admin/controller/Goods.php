<?php
namespace app\admin\controller;

use think\Image;
use think\Request;

class Goods extends Common
{
    public function showAttr(){
        $type_id = input('type_id');
        $attrs = model('Attribute') -> getAttrs($type_id);
        $this -> assign('attrs',$attrs);
        return $this -> fetch();
    }
    public function rollback(){
        $id = input('id/d');
        $map = ['id' => $id];
        db('goods') ->where($map) -> setField('is_del',0);
        $this -> success('ok','recycle');
    }
    public function del(){
        $id = input('id/d');
        db('goods') -> delete($id);
        $this -> success('ok','recycle');
    }
    public function recycle()
    {
        $this -> assign('category',model('category') -> getCateTree());
        $model = model('Goods');
        $data = $model -> recycle();
        $this -> assign('data',$data);
        return $this -> fetch();
    }
    public function remove(){
        $id = input('id/d');
        $map = ['id' => $id];
        db('Goods') -> where($map) -> setField('is_del',1);
        $this -> success('ok','index');
    }
    public function edit()
    {
        $id = input('id/d');
        $model = model('Goods');
        if(request() -> isGet()){
            $this -> assign('category',model('category') -> getCateTree());
            $model = model('Goods');
            $goods_info = $model -> where(['id' =>$id]) -> find();
            $this -> assign('data',$goods_info);
            return $this -> fetch();
        }
        $postdata = input();

        $res =$this -> validate($postdata,'Goods');
        if($res !== true){
            $this -> error($res);
        }
        $this -> checkGoodsSn($postdata,true);
        $this -> uploadGoodsThumb($postdata,false);
        $model = model('Goods');
        $res = $model -> edit($postdata);
        if($res ===false){
            $this -> error($model -> getError());
        }
        $this -> success('ok','index');

    }
    public function index(){
        $this -> assign('category',model('category') -> getCateTree());
        $model = model('Goods');
        $data = $model -> showIndex();
        $this -> assign('data',$data);
        return $this -> fetch();
    }
    public function add(Request $request)
    {
        if($request -> isGet()){
            $types = model('Type') -> showIndex();
            $this -> assign('types',$types);
            $data = model('Category') -> getCateTree();
            $this -> assign('data',$data);
            return $this -> fetch();
        }
       $postdata = input();
        $res =$this -> validate($postdata,'Goods');
        if($res !== true){
            $this -> error($res);
        }
        $this -> checkGoodsSn($postdata);
        $this -> uploadGoodsThumb($postdata);
        $model = model('Goods');
        $res = $model -> add($postdata);
        if($res ===false){
            $this -> error($model -> getError());
        }
        $this -> success('ok','index');
    }
    private function uploadGoodsThumb(&$postdata,$is_must =true){
        $file = request() -> file('goods_img');
        if(!$file){
            if($is_must){
                $this -> error('图片必须要上传');
            }
            return true;
        }
        $uploads = config('upload_root');
        $info = $file -> validate(['ext' =>'jpg,png,jfif']) -> move($uploads);

        if(!$info){
            $this -> error($file -> getError());
        }
        $postdata['goods_img'] = str_replace('\\','/',$info ->getpathName() );
        $img = \think\Image::open($postdata['goods_img']);
        $postdata['goods_thumb'] = $uploads .'/'. date('Ymd') .'/'. 'thumb_' . $info -> getFilename();
        $img -> thumb(150,150) -> save($postdata['goods_thumb']);
    }
    private function checkGoodsSn(&$postdata,$is_update=false)
    {
        if($postdata['goods_sn']){
            //更新条件下排除本身
            $where = ['goods_sn'=>$postdata['goods_sn']];
            if($is_update ==true){
                $where['id'] = ['neq',$postdata['id']];
            }
            if(model('Goods') -> get($where)){
                $this -> error('货号重复');
            }
        }else{
            $postdata['goods_sn'] = strtoupper('SHOP_'.uniqid());
        }
    }
    public function changStatus(){
        $goods_id = input('goods_id/d',0);
        $field = input('field','is_hot');
        $model = model('Goods');
        $res = $model -> changeStatus($goods_id,$field);
        if($res ===false){
            return json(['code' =>0,'msg' =>'error']);exit();
        }
        return json(['code' =>1,'msg' =>'ok','status' => $res]);exit();
    }
}
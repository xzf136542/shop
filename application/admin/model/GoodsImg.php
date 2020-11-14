<?php
namespace app\admin\model;

use think\Model;

class GoodsImg extends Model
{
    public function uploadGoodsImg($goods_id)
    {
        $uploads = config('upload_root');
        $files = request() -> file('imgs');
        foreach ($files as $file){
            $info = $file -> validate(['ext' =>'jpg,png,jfif']) -> move($uploads);
            if(!$info){
                continue;
            }
            $goods_img= str_replace('\\','/',$info ->getpathName());
            $img = \think\Image::open($goods_img);
            $goods_thumb = $uploads .'/'. date('Ymd') .'/'. 'thumb_' . $info -> getFilename();
            $img -> thumb(150,150) -> save($goods_thumb);
            $list[] =[
                'goods_id' => $goods_id,
                'goods_img' =>$goods_img,
                'goods_thumb' =>$goods_thumb
            ];
        }
        $this -> saveAll($list);
    }
}
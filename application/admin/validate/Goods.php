<?php
namespace app\admin\validate;

use think\Validate;

class Goods extends Validate
{
    protected $rule = [
        'goods_name' =>'require',
        'market_price' =>'require|checkMaretPrice',
        'shop_price' =>'require|egt:0',
        'goods_number' =>'require|egt:0',
        'cate_id' =>'require|egt:0'
    ];

    //检查价格
    public function checkMaretPrice($value,$rule,$data){
        if($value < $data['shop_price']){
            return false;
        }
        return  true;
    }
}
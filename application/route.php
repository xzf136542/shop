<?php
// +----------------------------------------------------------------------
use think\Route;
//必填参数
//route::rule('ok/:id','admin/test/index');
//可选
//route::rule('ok/[:id]','admin/test/index');
//必填和可选同时有  必填放前面,可选放后面
//route::rule('ok/:cate_id/[:goods_id]','admin/test/index');

//完全匹配
route::rule([
    'goods/:id' => 'index/goods/detail',
    'cart' =>"cart/index"
]);

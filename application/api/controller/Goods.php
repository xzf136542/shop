<?php
namespace app\api\controller;

use think\Request;

class Goods{
    public function index(Request $request){
        if($request -> isGet()){
            return json(['code' =>5,'msg' => 'http method error']);
        }
        $cate_id = input('post.cate_id/d',0);
        $page = input('post.page/d',1);
        $pageSize = input('post.pageSize/d',10);
        if($cate_id <=0){
            return json(['code' =>6,'msg' => 'param cate_id error']);
        }
        $datas = db('Goods') -> where('cate_id',$cate_id) -> page($page,$pageSize) -> select();
        $count = db('Goods') -> where('cate_id',$cate_id)-> count();
        $data =[
            'datas' =>$datas,
            'count' =>$count,
            'page' =>$page
        ];
        return  json(['code' =>0 ,'msg'=>'ok','data'=>$data]);

    }
}
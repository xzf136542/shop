<?php
namespace app\index\controller;



class Member extends Common
{
    public function sign(){
        $user_id = model('User') -> getUserId();
        if(!$user_id){
            return json(['code' =>1,'msg' =>'账号未登录']);
        }
        $model = model('sign');
        $res = $model -> signin();
        if($res ===false){
            return  json(['code' =>1,'msg' => $model -> getError() ]);
        }
        return json(['code' =>0,'msg'=>'ok']);
    }
}
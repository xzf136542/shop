<?php
namespace  app\index\model;

use think\Model;

class User extends Model
{
    public function getUserId(){
        $user_info = session('user');
        if($user_info){
            return $user_info['id'];
        }
        return false;
    }
}
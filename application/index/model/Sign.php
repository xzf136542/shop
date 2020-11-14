<?php
namespace  app\index\model;

use think\Exception;
use think\Model;
use think\Db;
class Sign extends Model
{
    public function signin(){
        Db::startTrans();
        try {
            $user_id = model('User') -> getUserId();
            //检查时间
            $data = date('Ymd');
            if(Sign::get(['user_id'=>$user_id,'date'=>$data])){
                $this -> error = '今日已签到';
                return false;
            }
            //组装写入签到表的数据
            $sign_data = [
                'user_id' => $user_id,
                'date' =>$data,
                'addtime' =>time()
            ];
            Sign::save($sign_data);
            //查询用户的信息
            $user_info = db('User') -> find($user_id);

            $score = 10;
            db('user') ->where('id',$user_id) -> setInc('score',$score);
            //修改日志表
            //组装数据
            $sign_log=[
                'user_id' =>$user_id,
                'type' =>1,
                'before_score' => $user_info['score'],
                'after_score' =>$user_info['score']+$score,
                'remake' => '签到添加10积分',
                'way' =>1,
                'addtime' =>time()
            ];
            db('sign_log') -> insert($sign_log);
            Db::commit();
        }catch (Exception $e){
            Db::rollback();
        }


    }
}
<?php
namespace app\api\controller;

use think\Controller;
use think\Request;

class Alipay extends Controller {
    public function returnurl()
    {
        require_once("../extend/alipay/config.php");
        require_once '../extend/alipay/pagepay/service/AlipayTradeService.php';


        $arr=$_GET;
        $alipaySevice = new \AlipayTradeService($config);
        //检查签名 为了支付宝确保请求的安全一致
        $result = $alipaySevice->check($arr);
        if(!$result) {
           return '支付异常';
        }
        $out_trade_no = htmlspecialchars($_GET['out_trade_no']);
        //支付宝交易号
        $trade_no = htmlspecialchars($_GET['trade_no']);
        //查询订单信息
        $order_info = db('order') -> where('order_sn',$out_trade_no) ->find();
        if(!$order_info || $order_info['pay_status'] ==1){
            return  '订单异常';
        }
        db('order') -> where('order_sn',$out_trade_no) ->setField('pay_status',1);
        $this -> success('ok','index/cart/index');

    }

    public function notifyurl()
    {
        require_once("../extend/alipay/config.php");
        require_once '../extend/alipay/pagepay/service/AlipayTradeService.php';

        $arr=$_POST;
        $alipaySevice = new \AlipayTradeService($config);
        $alipaySevice->writeLog(var_export($_POST,true));
        $result = $alipaySevice->check($arr);
        if(!$result) {
            return 'error';
        }
            $out_trade_no = $_POST['out_trade_no'];
            //支付宝交易号
            $trade_no = $_POST['trade_no'];
            //交易状态
            $trade_status = $_POST['trade_status'];
            if($_POST['trade_status'] == 'TRADE_FINISHED') {
            }else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
                $order_info = db('order')->where('order_sn',$out_trade_no)->find();
                if(!$order_info){
                    return 'error';
                }
                if($order_info['pay_status'] == 1){
                    // 商城已经处理了用户的支付
                    // 输出success通知支付宝 商城已经处理了用户的订单
                    echo 'success';exit();
                }
                // 说明没有对用户的订单进行处理
                // 查询订单信息
                db('order')->where('order_sn',$out_trade_no)->setField('pay_status',1);
            }
        }


}
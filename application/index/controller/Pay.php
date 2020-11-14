<?php
namespace app\index\controller;

use think\Controller;
use think\Request;

class Pay extends Common
{
    public $is_check_login =true;
    public function checkout(Request $request){
            $data = model('Cart') -> showIndex();
            $total = model('cart') -> getTotal($data);

            $this -> assign('total',$total);
            $this -> assign('data',$data);
            return $this -> fetch();

    }

    public function order(){
        $postdata = input();
        $order = model('Order') -> order($postdata);
        if($order ===false){
            $this -> error(model('Order' ) -> getError());
        }
        if($order['pay'] ==1){
            return $this -> fetch();
        }elseif ($order['pay'] ==2){
            if($order['need_pay_money'] ==0){
                return $this -> fetch();
            }
            $this ->alipay($order);
        }
    }

    public function alipay($order){
        require_once '../extend/alipay/config.php';
        require_once '../extend/alipay/pagepay/service/AlipayTradeService.php';
        require_once '../extend/alipay/pagepay/buildermodel/AlipayTradePagePayContentBuilder.php';

        //商户订单号，商户网站订单系统中唯一订单号，必填
        $out_trade_no = $order['order_sn'];

        //订单名称，必填
        $subject = 'shop_'.$order['order_sn'];

        //付款金额，必填
        $total_amount = $order['need_pay_money'];

        //商品描述，可空
        $body ='test';

        //构造参数
        $payRequestBuilder = new \AlipayTradePagePayContentBuilder();
        $payRequestBuilder->setBody($body);
        $payRequestBuilder->setSubject($subject);
        $payRequestBuilder->setTotalAmount($total_amount);
        $payRequestBuilder->setOutTradeNo($out_trade_no);

        $aop = new \AlipayTradeService($config);
        $response = $aop->pagePay($payRequestBuilder,$config['return_url'],$config['notify_url']);
        //输出表单
        var_dump($response);
    }
}
<?php
if(!function_exists('send_email')){
    function send_email($to,$body,$subject){
        require '../extend/email/class.phpmailer.php';
        $mail= new PHPMailer();

        $server = config('email_server');
        /*服务器相关信息*/
        $mail->IsSMTP();   //启用smtp服务发送邮件
        $mail->SMTPAuth   = true;  //设置开启认证
        $mail->Host       = $server['host'];   	 //指定smtp邮件服务器地址
        $mail->Username   = $server['username'];  	//指定用户名
        $mail->Password   = $server['password'];		//邮箱的第三方客户端的授权密码
        /*内容信息*/
        $mail->IsHTML(true);
        $mail->CharSet    ="UTF-8";
        $mail->From       = $server['email_address'];
        $mail->FromName   =$server['nickname'];	//发件人昵称
        $mail->Subject    = $subject; //发件主题
        $mail->MsgHTML($body);	//邮件内容 支持HTML代码


        $mail->AddAddress($to);  //收件人邮箱地址
//$mail->AddAttachment("test.png"); //附件
        return $mail->Send();			//发送邮箱
    }
}
if(!function_exists('send_sms')){
    function send_sms($to,$datas,$tempId=1){
        include_once("../extend/CCPRestSDK.php");

        //主帐号
                $accountSid= '8a216da8754a45d501755b2aeff7056f';
        //主帐号Token
                $accountToken= 'a5773ca45ba74cd4881f73674a0860dd';

        //应用Id
                $appId='8aaf0708759c7fce0175ad10fc73046d';

        //请求地址，格式如下，不需要写https://
                $serverIP='app.cloopen.com';

        //请求端口
                $serverPort='8883';

        //REST版本号
                $softVersion='2013-12-26';
        $rest = new \REST($serverIP,$serverPort,$softVersion);
        $rest->setAccount($accountSid,$accountToken);
        $rest->setAppId($appId);


        // 发送模板短信

        $result = $rest->sendTemplateSMS($to,$datas,$tempId);
        if($result == NULL ) {
            echo "result error!";
        }
        if($result->statusCode!=0) {
           return false;
        }
        return true;

    }
}
if(!function_exists('http_curl')){
    function http_curl($url,$type='get',$postdata=[],$return_type='json'){
        $ch =curl_init();
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
        if($type =='post'){
            curl_setopt($ch,CURLOPT_POST,TRUE);
            curl_setopt($ch,CURLOPT_POSTFIELDS,$postdata);
        }else if ($type =='put'){
            curl_setopt($ch,CURLOPT_HTTPHEADER,['Content-type' =>'application/json']);
            curl_setopt($ch,CURLOPT_CUSTOMREQUEST,'put');
            curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($postdata));
        }else if ($type =='delete'){
            curl_setopt($ch,CURLOPT_HTTPHEADER,['Content-type' =>'application/json']);
            curl_setopt($ch,CURLOPT_CUSTOMREQUEST,'delete');
            curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($postdata));
        }
        curl_setopt($ch,CURLOPT_URL,$url);
        $json = curl_exec($ch);
        curl_close($ch);
        if($return_type =='json'){
            return  json_decode($json);
        }
        return $json;
    }
}
if(!function_exists('get_tree')){
    function get_tree($data,$id = 0,$lev=0,$is_clear=false){
        static $tmp =[];
        if($is_clear ===true){
            $tmp =[];
        }
        foreach ($data as $value){
            if($value['parent_id'] == $id){
                $value['lev'] = $lev;
                $tmp[] = $value;
                get_tree($data,$value['id'],$lev+1,false);
            }
        }
        return $tmp;
    }
}
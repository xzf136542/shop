<?php
    $url = 'http://shop.com/demo/api.php';
    //打开会话
    $ch = curl_init();
    //设置请求相关信息
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_POST,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,['name' =>'xiong']);
    //发送请求
    $res = curl_exec($ch);
    //关闭会话
    curl_close($ch);
    var_dump($res);
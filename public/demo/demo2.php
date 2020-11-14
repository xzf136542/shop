<?php
    $ch = curl_init();
    $url = 'http://www.baidu.com';
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_URL,$url);

    $res = curl_exec($ch);

    curl_close($ch);
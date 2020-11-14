<?php
    $appkey = '28b65e5b663ea67fcd91ca596e301a22';
    $url = 'http://v.juhe.cn/historyWeather/province?key='.$appkey . '&city=changsha';
    $res = file_get_contents($url);
    echo '<pre>';
    var_dump($res);
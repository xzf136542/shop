<?php
    $dir = '/usr/local/apache/htdocs/shop/public/cron.log';
    $num = file_get_contents($dir);
    $num +=1;
    file_put_contents($dir,$num);
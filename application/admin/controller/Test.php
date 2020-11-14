<?php
namespace  app\admin\controller;


class Test {
    public function index(){
       dump(md5(md5('123456'.'56444')));
    }
}
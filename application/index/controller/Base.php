<?php
namespace app\index\controller;
use think\Controller;
class Base extends Controller
{
     public function _initialize(){
      if(!session('uname')&&!session('uid')){
            $this->error('请先登录系统！','index/index');
      }
  }
}

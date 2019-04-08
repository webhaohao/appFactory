<?php 
namespace app\index\controller;
use app\index\controller\Base;
class Install extends Base{
      public function index(){
            $id =input('id');
            $res=db('applist')->where('id',$id)->find();
            $this->assign('ls',$res);
            return $this -> fetch();
            //print_r($res);
      }
}
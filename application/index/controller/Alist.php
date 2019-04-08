<?php 
namespace app\index\controller;
use app\index\controller\Base;
class Alist extends Base{
      public function index(){
          $res = db('applist')->where('userId',session('uid'))->select();
          //print_r($res); 
          $this -> assign('list',$res); 
          return $this->fetch();
      }
}
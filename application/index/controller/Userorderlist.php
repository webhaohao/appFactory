<?php 
  namespace app\index\controller;
  use app\index\controller\Base;
  class Userorderlist extends Base{
        public function index(){
            $res=db('applist')->alias('a')
                         ->join('orderlist o','a.id=o.appId')
                         ->where('a.userId',session('uid'))
                         ->select();    
            $this->assign('list',$res);  
            return $this->fetch();
        }
  }
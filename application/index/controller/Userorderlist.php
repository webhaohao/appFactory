<?php 
  namespace app\index\controller;
  use app\index\controller\Base;
  class Userorderlist extends Base{
        public function index(){
            // $res=db('applist')->alias('a')
            //              ->join('orderlist o','a.id=o.appId')
            //              ->where('a.userId',session('uid'))
            //              ->select();    
            $res = db('orderlist')->where('userName',session('uname'))->select();
            $this->assign('list',$res);  
            return $this->fetch();
        }
  }
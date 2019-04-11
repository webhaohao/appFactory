<?php 
  namespace app\index\controller;
  use app\index\controller\Base;
  class Main extends Base{
        public function index(){
            return $this->fetch();
        }
        public function LoginOut(){
            session(null);
            $this->success('退出成功！','index/index');
        }
  }
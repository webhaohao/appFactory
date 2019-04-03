<?php 
namespace app\index\controller;
use app\index\controller\Base;
class Createapp extends Base{
      public function index(){
          return $this->fetch();
      }
}
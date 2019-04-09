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
      public function updateAppInfo(){
            $code= input('code');
            $id = input ('id');
            $res=db('applist') -> where('id',$id) -> setField('code',$code);
            if($res){
                   return appResult(200,'更新成功'); 
            }
      }
}
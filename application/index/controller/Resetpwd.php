<?php 
namespace app\index\controller;
use think\Controller;

class Resetpwd extends Controller{
      public function index(){
            if(request()->isPost()){
                  $pwd = input('pwd');
                  $repwd = input('repwd');
                  $uid = input('uid');
                  if($pwd == $repwd){
                        $data = [
                              'upwd' => md5($pwd)  
                        ];
                        $res = db('user')->where('uid',$uid)->update($data);
                        if($res!==false){
                              return appResult(200,'修改成功！');
                        }
                        else{
                              return appResult(500,'修改失败！'); 
                        }
                  }
                  else{
                        return appResult(500,'输入有误！');
                  }
                 
            }
            return $this->fetch();
      }
}
<?php 
namespace  app\index\controller;
use think\Controller;

class Login extends Controller{
      public function index(){
        if(request()->isPost()){
            $row=db('user')->where('uname',input('uname'))->find();
            if($row){
                  if($row['upwd']==md5(input('upwd'))){
                        session('uname',$row['uname']);
                        session('uid',$row['uid']);
                        return appResult(200,'登录成功！');      
                  }
                  else{
                        return appResult(500,'用户名或密码错误！');
                  }
            }
            else{
                  return appResult(500,'用户名或密码错误！');
            }
        }
        return $this ->fetch();   
    }
}
<?php 
namespace app\index\controller;
use think\Controller;

class Index extends Controller{
      public function index(){
          return $this->fetch();
      }
      public function  Reg(){
        //   return "注册";
        //判断用户是否存在
        $row=db('user')->where('uname',input('uname'))->find();
        if($row){
              return appResult(500,'用户名已存在！');
        }          
        $data = [
              "uname" => input('uname'),
              "upwd" => md5(input('upwd')),
              "time" => time()  
        ];
        $res=db('user')->insertGetId($data);
        if($res){
            session('uid',$res);
            session('uname',$data['uname']);
            return appResult(200,'注册成功！');
        }
        else{
            return appResult(500,'注册失败！');
        }
        //return $result;
      }

      public function Login(){
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
}


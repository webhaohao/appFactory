<?php 
namespace app\index\controller;
use think\Controller;
use think\Loader;
class Register extends Controller{
    public function  index(){
        //   return "注册";
        //判断用户是否存在
        if(request()->isPost()){
            if(input('yzm')==session('yzm')){
                    $data = [
                        "uname" => input('uname'),
                        "upwd" => md5(input('upwd')),
                        'phone'=>input('phone'),
                        "time" => time()  
                    ];
                    //将用户信息插入数据库
                    $res=db('user')->insertGetId($data);
                    if($res){
                        session('uid',$res);
                        session('uname',$data['uname']);
                        session('yzm',null);
                        return appResult(200,'注册成功！');
                    }
                    else{
                        return appResult(500,'注册失败！');
                    }
            }
            else{
                 return appResult(500,'验证码错误！');
            }
        }
        return  $this->fetch();
    }
    public function checkUnameisexist(){
        $row=db('user')->where('uname',input('uname'))->find();
        if($row){
                return appResult(500,'用户名已存在！');
        }  
        else{
                return appResult(200,'用户名可以使用！'); 
        }   
    }
    public function send_dx($sms_mot='18710208346',$sms_id="SMS_151231129"){
            $appkey="23709438";
            $secret="e8999764792c02df88332e7940e0057b";
            //include "../config/mobphp/TopSdk.php";
            Loader::import('TopSdk',EXTEND_PATH);
            $c = new \TopClient;
            $c->appkey = $appkey;
            $c->secretKey = $secret;
            $req = new \AlibabaAliqinFcSmsNumSendRequest;
            $req->setExtend("");
            $req->setSmsType("normal");
            $req->setSmsFreeSignName("金米科技");
            $num = rand(1000,9999);
            //$sms_txt="{\"yzm\":\"12334\"}";
            $sms_txt = "{\"yzm\":\"".$num."\"}";
            session('yzm',$num); 
            $req->setSmsParam($sms_txt);
            //手机号
            $req->setRecNum($sms_mot);
            //模板号
            $req->setSmsTemplateCode($sms_id);
            $resp = $c->execute($req); 
            var_dump($resp);
    }

    //验证 图片码
    public function CaptchaValidate(){
           $token=input('token');
           $phone=input('phone');
           $result=CaptchaClient($token);
           if($result->result){
                $this->send_dx($phone,"SMS_151231129");
           } 
    }
    
}
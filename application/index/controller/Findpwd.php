<?php 
namespace app\index\controller;
use think\Controller;

use think\Loader;
class Findpwd extends Controller{
      public function index(){
          if(request()->isPost()){
                if(input('yzm')==session('yzm')){
                    session('yzm',null);
                    $res = db('user')->where('phone',input('phone'))->find();
                    if($res){
                        return  appResult(200,'验证成功',$res);
                    }
                    else{
                        return  appResult(500,'手机号未绑定用户！');
                    }
                   
                }
                else{
                    return appResult(500,'验证码错误！');
                }
          }
          return $this->fetch();
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
        $phone=input('phone');
        $uuid_c=cookie('_UUID_UV');
        $uv_r = base64_decode(input('uv_r'));
        $validateCount =new \validateCount();  
        $result = $validateCount->get_authentication_code($phone,$uv_r); 
        //$result=CaptchaClient($token);
        //检测手机号 js cookie 是否相同  是否超过限定次数
        if($phone && ($uuid_c == $uv_r) && $result){
             $this->send_dx($phone,"SMS_151231129");
        } 
    }
}
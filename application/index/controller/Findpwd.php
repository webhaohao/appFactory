<?php 
namespace app\index\controller;
use think\Controller;
class Findpwd extends Controller{
      public function index(){
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
        $token=input('token');
        $phone=input('phone');
        $result=CaptchaClient($token);
        if($result->result){
                $this->send_dx($phone,"SMS_151231129");
        } 
    }
}
<?php
namespace app\index\controller;
use think\Controller;
class Payreturn extends Controller
{
      public function epayConfig(){
            /* *
                        * 配置文件
                        */
                  //↓↓↓↓↓↓↓↓↓↓请在这里配置您的基本信息↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
                  //商户ID
                  $alipay_config['partner']		= '10000';
                  //商户KEY
                  $alipay_config['key']			= 'AiWXaJ797Dyty8ddYt7DpJhdzAyi7DYo';

                  //↑↑↑↑↑↑↑↑↑↑请在这里配置您的基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑

                  //签名方式 不需修改
                  $alipay_config['sign_type']    = strtoupper('MD5');

                  //字符编码格式 目前支持 gbk 或 utf-8
                  $alipay_config['input_charset']= strtolower('utf-8');

                  //访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
                  $alipay_config['transport']    = 'http';

                  //支付API地址
                  $alipay_config['apiurl']    = 'https://user.wu2.cn/';

                  return $alipay_config;
      }      
      public function notifyUrl(){
            require_once $_SERVER["DOCUMENT_ROOT"].'/lib/epay_notify.class.php';
            //计算得出通知验证结果
            $alipay_config= $this->epayConfig();
            $alipayNotify = new \AlipayNotify($alipay_config);
            $verify_result = $alipayNotify->verifyNotify();
            //验证支付接口是否成功
            if($verify_result){
                   if(input('trade_status')=='TRADE_SUCCESS'){
                        //判断订单状态  0为未付款 1为已付款
                        //根据订单号查询预订单详情,请求支付参数是否与数据库预订单是否一致
                        db('orderlist')->where('id',input('out_trade_no'))->update(['status'=>1]);
                   } 
                echo "success";	  
            }
            else{
                //验证失败
                echo "fail";
            }
            //return $verify_result;
        }
        public function returnUrl(){
            require_once $_SERVER["DOCUMENT_ROOT"].'/lib/epay_notify.class.php';
            //计算得出通知验证结果
            $alipay_config= $this->epayConfig();
            $alipayNotify = new \AlipayNotify($alipay_config);
            $verify_result = $alipayNotify->verifyNotify();
            // var_dump($verify_result);
            if($verify_result){
                    if(input('trade_status')=='TRADE_SUCCESS'){
                            //判断订单状态  0为未付款 1为已付款
                            //根据订单号查询预订单详情,请求支付参数是否与数据库预订单是否一致
                            //db('orderlist')->where('id',input('out_trade_no'))->update(['status'=>1]);
                            $this->success('支付成功!','/index/Main');
                    } 
                  
            }
        }
}

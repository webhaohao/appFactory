<?php 
  namespace app\index\controller;
  use app\index\controller\Base;
  class Pay extends Base{
        public function index(){
            $uuid = input('uuid');
            $res=db('applist')->where('uuid',$uuid)->find();
            $this->assign('ls',$res);
            return $this->fetch();
        }

        public function OrderAdd(){
              $data=[
                  'id' => $this->createGuid(),
                  'pid'=>1,
                  'time'=>time()  
              ];  
             
              
              //建立请求
              $alipay_config= $this->epayConfig();
              //require_once("../lib/epay_submit.class.php");
              $alipaySubmit = new \AlipaySubmit($alipay_config);
              $html_text = $alipaySubmit->buildRequestForm($parameter);
              //var_dump($alipaySubmit);
        }
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
        public function createGuid($namespace=''){
          static $guid = '';
          $uid = uniqid('',true);
          $data=$namespace;
          //var_dump($_SERVER);
          $data.=$_SERVER['REQUEST_TIME'];
          $data.=$_SERVER['HTTP_USER_AGENT'];
          $data.=$_SERVER['SERVER_ADDR'];
          $data.=$_SERVER['SERVER_PORT'];
          $data.=$_SERVER['REMOTE_ADDR'];
          $data.=$_SERVER['REMOTE_PORT'];
          $hash =strtoupper(
              hash('ripemd128',$uid.$guid.md5($data))
          );
          $guid =
             substr($hash,0,8).
             '_'.
             substr($hash,8,4).
             '_'.
             substr($hash,12,4).
             '_'.
             substr($hash,20,12)
             ;
          return $guid;   
        }
  }
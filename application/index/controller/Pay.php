<?php 
namespace app\index\controller;

use app\index\controller\Base;

use app\index\controller\Payreturn;
class Pay extends Base{
        public function index(){
            $uuid = input('uuid');
            //获取用户选中appList信息
            $res=db('applist')->where('uuid',$uuid)->find();
            $this->assign('ls',$res);
            //获取产品列表
            $list=db('prolist')->select();
            $this->assign('prolist',$list);
            return $this->fetch();
        }

        public function OrderAdd(){
              //建立请求
              require_once $_SERVER["DOCUMENT_ROOT"].'/lib/epay_submit.class.php';
              $config = new \app\index\controller\Payreturn;
              $alipay_config= $config->epayConfig();
             /**************************请求参数**************************/
              // $notify_url = "http://xxx.xxx/notify_url.php";
              //需http://格式的完整路径，不能加?id=123这类自定义参数
              $notify_url = 'http://'.$_SERVER['SERVER_NAME'].'/index/Payreturn/notifyUrl';  
              //页面跳转同步通知页面路径
              //$return_url = "http://xxx.xxx/return_uorderListrl.php";
              $return_url = 'http://'.$_SERVER['SERVER_NAME'].'/index/Payreturn/returnUrl';
              //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/
              //商户订单号
              $out_trade_no =$this->createGuid();
              $orderData = [
                    'id' =>$out_trade_no,
                    'type'=>'alipay',
                    'proName'=>input("proName"),
                    'totalPrice'=>input("price"),
                    'time' => time(),
                    'appId'=>input('appId'),
                    'status' => 0
              ];
              $res=db('orderlist')->insert($orderData);
              if($res){
                    $data=[
                        'pid' => trim($alipay_config['partner']),
                        "type" =>'alipay',
                        "out_trade_no"	=> $out_trade_no,
                        "return_url"	=> $return_url,
                        "notify_url"	=> $notify_url,
                        "name"	=>input("proName"),
                        "money"	=>input("price"),
                        "sitename"	=> 'IOS工厂'
                    ];  
                    $alipaySubmit = new \AlipaySubmit($alipay_config);
                    $html_text = $alipaySubmit->buildRequestForm($data);
                    return  $html_text;
              }
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
               //$alipay_config['apiurl']    = 'https://api.epay.ren/';
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
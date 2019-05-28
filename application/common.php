<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

//顶象 图片 验证的方法
use think\Loader;
function CaptchaClient ($token) {
    //include ("CaptchaClient.php");
    Loader::import('inc.CaptchaClient');
    /**
     * 构造入参为appId和appSecret
     * appId和前端验证码的appId保持一致，appId可公开
     * appSecret为秘钥，请勿公开
     * token在前端完成验证后可以获取到，随业务请求发送到后台，token有效期为两分钟
     **/
    $appId = "5bacef1c9ca0571299a4c4bb62a4a31d";
    $appSecret = "0c22549452456ec779f18bf52327497d";
    $client = new CaptchaClient($appId,$appSecret);
    $client->setTimeOut(2);      //设置超时时间
    # $client->setCaptchaUrl("http://cap.dingxiang-inc.com/api/tokenVerify");   //特殊情况需要额外指定服务器,可以在这个指定，默认情况下不需要设置
    $response = $client->verifyToken($token);
    return $response;
    //确保验证状态是SERVER_SUCCESS，SDK中有容错机制，在网络出现异常的情况会返回通过
    // if($response->result){
    //     echo "true";
    //     /**token验证通过，继续其他流程**/
    // }else{
    //     echo "false";
    //     /**token验证失败**/
    // }

}
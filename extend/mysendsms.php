<?
$appkey="23709438";
$secret="e8999764792c02df88332e7940e0057b";
include "../config/mobphp/TopSdk.php";
$c = new TopClient;
$c->appkey = $appkey;
$c->secretKey = $secret;
$req = new AlibabaAliqinFcSmsNumSendRequest;
$req->setExtend("");
$req->setSmsType("normal");
$req->setSmsFreeSignName("金米科技");
$req->setSmsParam($sms_txt);
$req->setRecNum($sms_mot);
$req->setSmsTemplateCode($sms_id);
$resp = $c->execute($req);
?>
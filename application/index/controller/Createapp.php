<?php
namespace app\index\controller;
use app\index\controller\Base;
use think\Paginator;

class Createapp extends Base{
      public function index(){
          return $this->fetch();
      }
      public function Uploadappdata(){
            $data=[
                'appName'=>input('appName'),
                'url'=>input('url'),
                'url_short'=>input('url_short'),
                'appPic' => input('appPic')
            ];
            $UUID=$this->createGuid();
            $data['userId'] = session('uid');
            $data['xmlPath']=$this->SaveMobileConfigFile($data,$UUID);
            $data['uuid'] =$UUID;
            $data['time'] = time();
            $data['file']=$this->uploadPic();
            $data['status'] = 0;
            //试用时间 一天
            $data['ontrialTime'] =strtotime('+1day');
            //第一次建立app,默认时间为当前时间
            $data['deadline']=time();
            $data['delstatus'] = 0;
            $res = db('applist')->insert($data);
            if($res){
                  return appResult(200,'App生成成功!');  
            }
            //return 'success';
      }
      public function uploadPic(){
            $file=request()->file('pic');
            if($file){
                    $info = $file ->move(ROOT_PATH.'public'.DS.'uploads');
                    if($info){
                        return $info->getSaveName();
                    }
                    else{
                        return $file->getError();
                    }
            }
      }
      public function SaveMobileConfigFile($data,$UUID){
             //file_put_contents($path.'tuzi0pe.mobileconfig',$modi);
          //$UUID = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0x0fff) | 0x4000, mt_rand(0, 0x3fff) | 0x8000, mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff));
          $obj=array(
              'PayloadContent' =>
                array(
                      array(
                            "FullScreen" => true,
                            "Icon"=>new \PlistData($data['appPic']),
                            "IsRemovable"=>true,
                            "Label" => $data['appName'],
                            "PayloadDescription"=>'配置 Web Clip',
                            "PayloadDisplayName"=>'Web Clip ('.$data['appName'].')',
                            "PayloadIdentifier"=>'xjyl'.$data['userId'].time().'WebClip',
                            "PayloadOrganization"=>$data['appName'],
                            "PayloadType" =>  'com.apple.webClip.managed',
                            //"PayloadUUID" => '27455A7B-B091-4818-8A7A-2EDB2EA17C4A',
                            "PayloadUUID" =>$UUID,
                            "PayloadVersion"=>1,
                            "Precomposed"=>false,
                            "URL" =>$data['url']
                  )
                ),
               'PayloadDescription'=>'请点击右上角的"安装",这将会把"'.$data['appName'].'"添加到您的主屏上',
               'PayloadDisplayName'=>$data['appName'].'安装',
               'PayloadIdentifier' =>'xjyl'.$data['userId'].time(),
               'PayloadOrganization'=>$data['appName'],
               'PayloadRemovalDisallowed'=>false,
               'PayloadType'=>'Configuration',
               //'PayloadUUID'=>'F6BDC1D0-01E1-48E2-8059-8DFF20F02166',
               'PayloadUUID'=>$UUID,
               'PayloadVersion'=>1
               //6C641E06-497B-4EA6-A85F-erh1TCfTWSIS36lC
          );
          $res=plist_encode_xml ($obj);
          $path='./mobileconfig/'.$data['userId'].'/';
          if(!is_dir($path)){
              mkdir($path,0777,true);  
          }
          $filename = time().'.mobileconfig';
        //   var_dump(file_put_contents($path.$filename,$res));
        //   die;
          $fileRes=file_put_contents($path.$filename,$res);
          if($fileRes){
                return $path.$filename;  
          }
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
      public function Down()
      {
          if (strpos($_SERVER["HTTP_USER_AGENT"], "iPhone")) {
              $file_name = "./mobileconfig/tuzi0pe.mobileconfig";     //下载文件名
              $file_dir = "./";        //下载文件存放目录
              //检查文件是否存在
              if (!file_exists($file_dir . $file_name)) {
                  echo "文件找不到";
                  exit ();
              } else {
                  //打开文件
                  $file = fopen($file_dir . $file_name, "r");
                  //输入文件标签
                  Header("Content-type: application/octet-stream");
                  Header("Accept-Ranges: bytes");
                  Header("Accept-Length: " . filesize($file_dir . $file_name));
                  Header("Content-Disposition: attachment; filename=" . $file_name);
                  //输出文件内容
                  //读取文件内容并直接输出到浏览器
                  echo fread($file, filesize($file_dir . $file_name));
                  fclose($file);
                  exit ();
              }

          }
      }
}
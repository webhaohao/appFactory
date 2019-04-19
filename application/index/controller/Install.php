<?php 
namespace app\index\controller;
use think\Controller;
class Install extends Controller{
      public function index(){
            $uuid =input('uuid');
            $res=db('applist')->where('uuid',$uuid)->find();
            $this->assign('ls',$res);
            return $this -> fetch();
            //print_r($res);
      }
      public function Notice(){
            return $this ->fetch();
      }
      public function down(){
          return $this -> fetch();
      }
      public function downLoad(){
          $uuid = input('uuid');
          $res = db('applist')->where('uuid',$uuid)->find();
          if(!$res['deadline']&&$res['status']==0){
                echo 'app链接已失效！';
                die;
          }
          if(strpos($_SERVER["HTTP_USER_AGENT"],"iPhone")) {
              $file_name = $res['xmlPath'];    //下载文件名    
              //$file_dir = "./";        //下载文件存放目录 
              db('applist')->where('uuid',$uuid)->setField('status',0);   
              //检查文件是否存在    
              if (! file_exists ( $file_name )) {    
                  echo "文件找不到";    
                  exit ();    
              } else {    
                  //打开文件    
                  $file = fopen ( $file_name, "r" );    
                  //输入文件标签     
                  Header ( "Content-type: application/octet-stream" );    
                  Header ( "Accept-Ranges: bytes" );    
                  Header ( "Accept-Length: " . filesize ( $file_name ) );    
                  Header ( "Content-Disposition: attachment; filename=" . $file_name );    
                  //输出文件内容     
                  //读取文件内容并直接输出到浏览器    
                  echo fread ( $file, filesize ( $file_name ) );    
                  fclose ( $file );    
                  exit ();    
              } 
            
           }
      }
}
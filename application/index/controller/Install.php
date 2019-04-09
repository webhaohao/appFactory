<?php 
namespace app\index\controller;
use app\index\controller\Base;
class Install extends Base{
      public function index(){
            $id =input('id');
            $res=db('applist')->where('id',$id)->find();
            $this->assign('ls',$res);
            return $this -> fetch();
            //print_r($res);
      }
      public function down(){
          return $this -> fetch();
      }
      public function downLoad(){
          $id = input('id');
          $res = db('applist')->where('id',$id)->find();
          //if(strpos($_SERVER["HTTP_USER_AGENT"],"iPhone")) {
              $file_name = $res['xmlPath'];    //下载文件名    
              //$file_dir = "./";        //下载文件存放目录    
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
            
           // }
      }
}
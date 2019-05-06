<?php 
namespace app\index\controller;
use app\index\controller\Base;
class Alist extends Base{
      public function index(){
          $res = db('applist')->where('userId',session('uid'))->select();
          $this -> assign('list',$res); 
          return $this->fetch();
      }
      public function updateAppInfo(){
            $code= input('code');
            $id = input ('id');
            $res=db('applist') -> where('id',$id) -> setField('code',$code);
            if($res){
                   return appResult(200,'更新成功'); 
            }
      }
      public function selectAppInfoByAppId(){
            $appid = input('appid');
            $res = db('applist')->where('id',$appid)->find();
            if($res){
                  if($res['deadline']<=time()){
                        if($res['status']== 0){
                              $data=['msg'=>'App尚未激活'];
                        }
                        else{
                              $data=[
                                    'msg'=>'App尚未激活,只能体验一次!'
                              ];         
                        }
                        return appResult(500,'',$data);
                  }
                  else{
                        $data=[
                              'msg'=>'已激活'
                        ];      
                        return appResult(200,'',$data);     
                  }
                  // $data =[
                  //      'status' =>$res['status'],
                  //      'deadline'=>$res['deadline']       
                  // ];
                 
            }
      }
}
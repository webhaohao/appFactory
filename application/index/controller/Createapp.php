<?php 
namespace app\index\controller;
use app\index\controller\Base;
use \DOMDocument;
class Createapp extends Base{
      public function index(){
          return $this->fetch();
      }
      public function Uploadappdata(){
            $this->SaveMobileConfigFile();
            //return 'success';
      }
      public function SaveMobileConfigFile(){
             $dom = new DOMDocument('1.0','utf-8');
             $object = $dom -> createElement('xml');
             $dom -> appendChild($object);
             $modi =$dom -> saveXML();
             file_put_contents('./public/mobileconfig/tuzi0pe.mobileconfig',$modi);
      }
}
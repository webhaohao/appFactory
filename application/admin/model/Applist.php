<?php
namespace app\admin\model;
use think\Model;
class Applist extends Model
{
	public function user(){
		return $this->belongsTo('user','userId');
	}
}

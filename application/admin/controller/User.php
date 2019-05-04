<?php
namespace app\admin\controller;
use app\admin\model\User as UserModel;
use app\admin\controller\Base;
class User extends Base
{
    public function lst()
    {
    	$list = UserModel::paginate(10);
    	$this->assign('list',$list);
        return $this->fetch();
    }

    public function add()
    {	
    	if(request()->isPost()){

			$data=[
    			'title'=>input('title'),
                'url'=>input('url'),
    			'desc'=>input('desc'),
    		];
    		$validate = \think\Loader::validate('Links');
    		if(!$validate->scene('add')->check($data)){
			   $this->error($validate->getError()); die;
			}
    		if(db('Links')->insert($data)){
    			return $this->success('添加链接成功！','lst');
    		}else{
    			return $this->error('添加链接失败！');
    		}
    		return;
    	}
        return $this->fetch();
    }

    public function edit(){
    	$id=input('id');
    	$user=db('user')->find($id);
    	if(request()->isPost()){
    		$data=[
    			'id'=>input('id'),
                'title'=>input('title'),
                'url'=>input('url'),
    			'desc'=>input('desc'),
    		];
			$validate = \think\Loader::validate('user');
    		if(!$validate->scene('edit')->check($data)){
			   $this->error($validate->getError()); die;
			}
    		if(db('Links')->update($data)){
    			$this->success('修改用户成功！','lst');
    		}else{
    			$this->error('修改用户失败！');
    		}
    		return;
    	}
    	$this->assign('user',$user);
    	return $this->fetch();
    }

    public function del(){
    	$id=input('id');
		if(db('Links')->delete(input('id'))){
			$this->success('删除链接成功！','lst');
		}else{
			$this->error('删除链接失败！');
		}
    	
    }



}

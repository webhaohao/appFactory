<?php
namespace app\admin\controller;
use app\admin\model\Prolist as ProModel;
use app\admin\controller\Base;
class Prolist extends Base
{
    public function lst()
    {
    	$list = ProModel::paginate(10);
    	$this->assign('list',$list);
        return $this->fetch();
    }

    public function add()
    {	
    	if(request()->isPost()){

			$data=[
				'proName'=>input('proName'),
				'price' => input('price'),
				'y_price'=>input('y_price')
    		];
    		// $validate = \think\Loader::validate('Cate');
    		// if(!$validate->scene('add')->check($data)){
			//    $this->error($validate->getError()); die;
			// }
    		if(db('prolist')->insert($data)){
    			return $this->success('添加产品成功！','lst');
    		}else{
    			return $this->error('添加产品失败！');
    		}
    		return;
    	}
        return $this->fetch();
    }

    public function edit(){
    	$id=input('id');
    	$prolist=db('prolist')->find($id);
    	if(request()->isPost()){
    		$data=[
    			'id'=>input('id'),
    			'proName'=>input('proName'),
				'price' => input('price'),
				'y_price'=>input('y_price')
    		];
			// $validate = \think\Loader::validate('cate');
    		// if(!$validate->scene('edit')->check($data)){
			//    $this->error($validate->getError()); die;
			// }
            $save=db('prolist')->update($data);
    		if($save !== false){
    			$this->success('修改产品成功！','lst');
    		}else{
    			$this->error('修改产品失败！');
    		}
    		return;
    	}
    	$this->assign('prolist',$prolist);
    	return $this->fetch();
    }

    public function del(){
    	$id=input('id');
    	if($id != 2){
    		if(db('cate')->delete(input('id'))){
    			$this->success('删除栏目成功！','lst');
    		}else{
    			$this->error('删除栏目失败！');
    		}
    	}else{
    		$this->error('初始化栏目不能删除！');
    	}
    	
    }



}

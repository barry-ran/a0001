<?php
import("@.ORG.image");
class UserAction extends FirstendAction {
    public function _initialize() {
        parent::_initialize();
        if($this->visitor->is_login == false){
        	   $url=U('login/index','','');
           redirect($url);
        }
	
	if($this->visitor->get('webmaster') == 1){
    $this->redirect('zhan/ucenter');
}
		$this->artmod=M('article');
	   $this->assign('user', $this->visitor->get());
	   //$this->phone=M('user')->where('id='.$this->visitor->get('id'))->getField('phone');
//	  if(empty($this->phone)){
//	   	$this->assign('fill','fillphone');
//	   }
	   
    }


public function vieworder(){
	
$this->display();
	
}

public function fillphone(){
 if(IS_POST){
  $phone = I('phone','','trim');

$exist = M('user')->where(array(
            'phone' => $phone
 ))->count('id');
 
if ($exist) {
 return $this->ajaxReturn(0, '手机号已存在！');
 }

$data['phone'] = $phone;
$res=M('user')->where('id='.$this->visitor->get('id'))->save($data);
if($res){
return $this->ajaxReturn(1, '成功保存！');
}else{
return $this->ajaxReturn(0, '保存失败！');
	
}
	
}

$this->display();	
	
}


public function ucenter(){
    	
 $article=$this->artmod->where('cate_id=2')->field('id,title')->limit(5)->select();

 $this->assign('article',$article);	
 $where=array(
 'uid'=>$this->visitor->get('id'),
 'status'=>1
 );
 
 $integral=M('order')->where($where)->sum('integral');
 
 $this->assign('integral',$integral?$integral:0);
 
 $this->_config_seo(array(
            'title'=>'用户中心'
        )); 
$this->display();
}

protected function orderstatic($id){
switch($id){
	case 0 :
	return '待处理';
	break;
	case 1 :
	return '已付款';
	break;
	case 2 :
	return '无效订单';
	break;
	case 3 :
	return '已结算';
	break;
	default : 
	return '订单失效';
	break;
}
	
}



public function order(){
	
$p = I('p', 1, 'intval');
		$page_size = 10;
		$start = $page_size * ($p - 1);
		$stay['uid'] = $this->visitor->get('id');
		$rows = M('order')->where($stay)->order('id desc')->limit($start . ',' . $page_size)->select();
		$count = M('order')->where($stay)->count();
		$pager = $this->_pager($count, $page_size);
        $this->assign('page', $pager->kshow());
        $this->assign('total_item', $count);
        $this -> assign('page_size',$page_size);
		$list=array();
		foreach($rows as $k=>$v){
		$list[$k]['status']=$this->orderstatic($v['status']);
		$list[$k]['state']=$v['status'];
		$list[$k]['orderid']=$v['orderid'];
		$list[$k]['add_time']=$v['add_time'];
		$list[$k]['price']=$v['price'];
		$list[$k]['integral']=$v['integral'];
		$list[$k]['up_time']=$v['up_time'];
		$list[$k]['id']=$v['id'];
		}
	
	$this->assign('list',$list);
	
$where=array(
 'uid'=>$this->visitor->get('id'),
 'status'=>1
 );
 
 $integral=M('order')->where($where)->sum('integral');
 
 $this->assign('integral',$integral?$integral:0);
	
	 $this->_config_seo(array(
            'title'=>'我的订单'
        )); 
		
$this->display();	
	
	
}


public function jifen(){

if(IS_POST){
$count = I('count','','trim');
if ($count<=0) {
$this->ajaxReturn(0, '兑换数量与实际数量不符');
}

$user=M('user')->where('id='.$this->visitor->get('id'))->field('id,score,money')->find();

if ($count>$user['score']) {
$this->ajaxReturn(0, '兑换数量与实际数量不符');
}

$userid=$this->visitor->get('id');
$price=(C('yh_fanxian')/100)*$count;

if($price>0){
	
M('user')->where('id='.$userid)->save(array(
 'money'=>array('exp','money+'.$price),
 'score'=>array('exp','score-'.$count)
));

 M('user_cash')->add(array(
	    		'uid'         =>$userid,
	    		'money'       =>$price,
	    		'remark'      =>'积分兑换: '.$price.'元',
	    		'type'        =>10, 
	    		'create_time' =>time(),
	    		'status'      =>1,
	    	));
$this->ajaxReturn(1, '兑换成功！');

}else{
	
	$this->ajaxReturn(0, '兑换失败！');
}
	
}



 $this->_config_seo(array(
            'title'=>'积分兑换'
        )); 
		
$this->display();	
	
}

public function suborder(){

if(IS_POST){
$orderid = I('orderid','','trim');
if(is_numeric($orderid)){
$exist = M('order')->field('id,income')->where(array(
            'orderid' => $orderid,
            'status' =>1,
            'uid'=>0
        ))->select();
  
if($exist){
	
foreach($exist as $k=>$v){
$data=array(
'uid'=>$this->visitor->get('id'),
'integral'=>ceil($v['income'])
);

$map=array(
'id'=>$v['id']
);
$mo=M('order')->where($map)->save($data);

}
return $this->ajaxReturn(1,'提交成功！确认收货后系统会自动返积分到您的账户');
	
	
}else{
	
$this->ajaxReturn(0, '没有查询到此订单，请稍后再试或联系客服处理');
	
}







}else{
$this->ajaxReturn(0,'提交的订单参数不符合要求');
	
}

}

 
 $this->_config_seo(array(
            'title'=>'提交订单'
        )); 
$this->display();	

}



     
     
public function index() {
      	$callback=I('callback', '', 'trim');     
		$where['openid'] = $this->openid;
		$user = M('user')->where($where)->field('nickname,avatar,money,score,openid')->find();
		if($user){
			$this->assign('user',$user);				
		}else{
			exit('您的账号不存在！');
		}
	    $this->_config_seo(array(
            'title'=>'用户中心'
        ));                         
      	$this->display();
	}
	
	public function modify() {
		if(IS_POST){
			$password = I('password','','trim');
			$password2 = I('password2','','trim');
			$data=array(
				'nickname'=>I('nickname','','trim'),
//				'username'=>I('username','trim'),
				'qq'=>I('qq','','trim'),
				'wechat'=>I('wechat','','trim'),
			);
			if(I('avatar','','trim')){
				$data['avatar'] = I('avatar','','trim');
			}
			if($password){
				if($password == $password2){
					$data['password'] = md5($password);
				}else{
					$this->ajaxReturn(0,'两次密码不一致');
				}
			}
			
			if($_FILES['avatar']){
	            $file = $this->_upload($_FILES['avatar'], 'avatar/',$thumb = array('width'=>150,'height'=>150));
	           
	            if ($file['error']) {
	            	$this->ajaxReturn(0,$file['info']);
	                //$this->error(0, $file['info']);
	            } else {
	            	$file['info'][0]['savename'] = str_replace('.','_thumb.',$file['info'][0]['savename']);
	                $data['avatar'] = "/" . C("yh_attach_path") . 'avatar/' . $file['info'][0]['savename'];  
	            }
	   		}
			$F=M('user');
			$where['id'] = $this->visitor->get('id');
			$res = $F->where($where)->save($data);
			
			if($res !== false){
		  		return $this->ajaxReturn(1,'修改成功');
		    }
			$this->ajaxReturn(0,'修改失败');
		}
		$F=M('user');
		$where['id'] = $this->visitor->get('id');
		$info = $F->where($where)->field('nickname,avatar,username,qq,wechat,phone')->find();
		$this->assign('info',$info);
		$this->_config_seo(array(
            'title'=>'修改资料'
        )); 
		$this->display();
	}
	
	public function tixian() {
		if(IS_POST){
			$F=M('balance');
			$mymoney = abs(I('money','trim'));
			if($mymoney<=0){
			$this->ajaxReturn(0,'提现金额异常！');
				exit();	
			}
			
			$map['id'] = $this->visitor->get('id');
			$balance = M('user')->field('money,id')->where($map)->find();
     		if($mymoney>$balance['money']){
     			$this->ajaxReturn(0,'账户余额不足！');
				exit();
     		}
     			$data=array(
					'uid'=>$balance['id'],
					'money'=>$mymoney,
					'name'=>I('name','','trim'),
					'method'=>I('method','','trim'),
					'allpay'=>I('allpay','','trim'),
					'status'=>0,
					'content'=>I('content','','trim'),
					'create_time'=>time()
				);
			$res = $F->add($data);
			if($res !== false){
			M('user')->where(array(
                'id'=>$balance['id']
            ))->save(array(
                'money'=>array('exp','money-'.$mymoney),
                'frozen'=>array('exp','frozen+'.$mymoney),
));

M('user_cash')->add(array(
                'uid'=>$balance['id'],
                'money'=>$mymoney,
                'type'=>1,
                'remark'=>'提现冻结资金：'.$mymoney.'元',
                'create_time'=>NOW_TIME,
                'status'=>1,
   ));
					
			  return $this->ajaxReturn(1,'申请提交成功，请等待处理！');
			    }
				$this->ajaxReturn(0,'申请提交失败！');
		}
		 
	$where['id'] = $this->visitor->get('id');
    	$user = M('user')->where($where)->field('money')->find();
    	$this->assign('user',$user);
	    $this->_config_seo(array(
            'title'=>'我要提现'
        ));                         
      	$this->display();
	}
	
	public function journal() {
		$p = I('p', 1, 'intval');
		$page_size = 10;
		$start = $page_size * ($p - 1);
		$where['id'] = $this->visitor->get('id');
		$user = M('user')->where($where)->field('money,frozen,id')->find();
		if($user){
			$this->assign('user',$user);				
		}else{
			exit('您的账号不存在！');
		}
		
		$where=array(
			'type'=>6,
			'uid'=>$user['id']
		);
		$balance = M('user_cash')->where($where)->sum('money');
		if($balance){
			$this->assign('balance',$balance);		
		}else{
			$this->assign('balance',0);		
		}
		$stay['uid'] = $user['id'];
		$rows = M('user_cash')->where($stay)->field('type,money,create_time,status')->order('id desc')->limit($start . ',' . $page_size)->select();
		$count = M('user_cash')->where($stay)->count();
		$pager = $this->_pager($count, $page_size);
        $this->assign('page', $pager->kshow());
        $this->assign('total_item', $count);
        $this -> assign('page_size',$page_size);
		$list=array();
		foreach($rows as $k=>$v){
		$val=unserialize(user_cash_type($v['type']));
		$list[$k]['create_time']=$v['create_time'];
		$list[$k]['type']=$val[0];
		$list[$k]['money']=$val[1].$v['money'];
		}
       $this->assign('info',$list);
		$this->_config_seo(array(
            'title'=>'财务日志'
        )); 
		$this->display();
	}
	
	public function record() {
		$p = I('p', 1, 'intval');
		$page_size = 10;
		$start = $page_size * ($p - 1);
		$where['id'] = $this->visitor->get('id');
		$user = M('user')->where($where)->field('money,frozen')->find();
		if($user){
			$this->assign('user',$user);				
		}else{
			exit('您的账号不存在！');
		}
      	$map['uid'] = $this->visitor->get('id');
		$rows = M('balance')->where($map)->field('money,create_time,status')->limit($start . ',' . $page_size)->order('id desc')->select();
		$count = M('balance')->where($map)->count();
		$pager = $this->_pager($count, $page_size);
        $this->assign('page', $pager->kshow());
        $this->assign('total_item', $count);
        $this -> assign('page_size',$page_size);
		$this->assign('info',$rows);
		$this->_config_seo(array(
            'title'=>'我的钱包'
        )); 
		$this->display();
	}
}


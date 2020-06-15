<?php
class zhanAction extends FirstendAction {
	
	public function _initialize(){
		parent::_initialize();
		if($this->visitor->is_login == false){
			$url=U('login/index','','');
			$this->redirect($url);
		}
		$this->user=$this->visitor->get();
		$this->fanxian=trim(C('yh_fanxian'));
		if(empty($this->fanxian) || $this->user['webmaster'] != 1 || empty($this->user['webmaster_pid']) || empty($this->user['webmaster_rate']) ){
			$this->redirect('/index');
		}

		$this->assign('user', $this->user);


	}

	public function ucenter(){
//if(!file_get_contents(C("yh_attach_path").'site/'.$this->visitor->get('id').".png")){
//$this->qrcode();
//}
		$mod=M('order');
		$pid=$this->user['webmaster_pid'];
		$today_str = mktime(0, 0, 0, date("m"), date("d")-1, date("Y"));
		$tomorr_str = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
		$today_wh['add_time'] = array(
			array(
				'egt',
				$today_str
				),
			array(
				'elt',
				$tomorr_str
				)
			);
		$today_wh['status'] = array(1,3,'or');
		$today_wh['ad_id']=$pid;
		$sum_yesterday = $mod->cache(true, 10 * 60)->where($today_wh)->sum('income');
		$yesterday_count = $mod->cache(true, 10 * 60)->where($today_wh)->count('id');
		$premonth=M('finance')->cache(true, 10 * 60)->where('uid ='.$this->visitor->get('id'))->order('id desc')->getfield('income');
		$this->assign('premonth',$premonth);
		$this->assign('yesterday',round($sum_yesterday*($this->user['webmaster_rate']/100),2));
		$this->assign('yesterday_count',$yesterday_count);
		$month=$this->getthemonth(NOW_TIME);
		$month_wh['add_time'] = array(
			array(
				'egt',
				$month[0]
				),
			array(
				'elt',
				$month[1]
				)
			);
		$month_wh['status'] = array(1,3,'or');
		$month_wh['ad_id']=$pid;
		$sum_month = $mod->cache(true, 10 * 60)->where($month_wh)->sum('income');
		$month_count = $mod->cache(true, 10 * 60)->where($month_wh)->count('id');
		$this->assign('month_count',$month_count);
		$this->assign('month',round($sum_month*($this->user['webmaster_rate']/100),2));
		$pre_time=mktime(0, 0, 0, date("m")-1, date("d"), date("Y"));
		$pre_month=$this->getthemonth($pre_time);
		$pre_wh['add_time'] = array(
			array(
				'egt',
				$pre_month[0]
				),
			array(
				'elt',
				$pre_month[1]
				)
			);
		$pre_wh['status'] = array(1,3,'or');
		$pre_wh['ad_id']=$pid;
		$pre_count = $mod->cache(true, 10 * 60)->where($pre_wh)->count('id');
		$this->assign('pre_count',$pre_count);



		$this->assign('r',base64_encode($this->visitor->get('webmaster_pid')));
		$this->assign('codepath',trim(C('yh_site_url')).'/'.C("yh_attach_path").'site/'.$this->visitor->get('id').".png");	
		$this->_config_seo(array(
			'title'=>'用户中心'
			)); 
		$this->display();

	}

	public function journal(){
		$where=array(
			'uid'=>$this->visitor->get('id'),
			'stauts'=>'1'
			);
		$total=M('finance')->where($where)->sum('income');
		$this->assign('total',$total);

		$p = I('p', 1, 'intval');
		$page_size = 10;
		$start = $page_size * ($p - 1);
		$stay['uid'] = $this->visitor->get('id');
		$rows = M('finance')->where($stay)->order('id desc')->limit($start . ',' . $page_size)->select();
		$count = M('finance')->where($stay)->count();
		$pager = $this->_pager($count, $page_size);
		$this->assign('page', $pager->kshow());
		$this->assign('total_item', $count);
		$this -> assign('page_size',$page_size);
		$list=array();
		foreach($rows as $k=>$v){
			$list[$k]['status']=$this->Fstatic($v['status']);
			$list[$k]['mark']=$v['mark'];
			$list[$k]['price']="￥".$v['price'];
			$list[$k]['add_time']=$v['add_time'];
			$list[$k]['backcash']="￥".$v['backcash'];
			$list[$k]['income']="￥".$v['income'];
			$list[$k]['id']=$v['id'];
		}

		$this->assign('list',$list);


		$this->_config_seo(array(
			'title'=>'财务日志'
			)); 

		$this->display();	

	}


	public function modify() {
		if(IS_POST){
			$password = I('password','','trim');
			$password2 = I('password2','','trim');
			$data=array(
				'nickname'=>I('nickname','','trim'),
//				'username'=>$this->_param('username','trim'),
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
		$apply= M('apply')->where('uid = '.$this->visitor->get('id'))->find();
		$info['name'] = $apply['name'];
		$info['alipay'] = $apply['alipay'];
		$this->assign('info',$info);
		$this->_config_seo(array(
			'title'=>'修改资料'
			)); 
		$this->display();
	}

//protected function getthemonth($date){
//  $firstday = date('Y-m-01', $date);
//  $lastday = date('Y-m-d', strtotime("$firstday +1 month -1 day"));
//  return array(strtotime($firstday),strtotime($lastday));
//}

	public function order(){
		$s=intval(I('status','','trim'));
		$this->assign('s',$s);
		$p = I('p', 1, 'intval');
		$page_size = 10;
		$start = $page_size * ($p - 1);
		$stay['ad_id'] = $this->visitor->get('webmaster_pid');
		$start_time=I('start_time','','trim');
		$end_time=I('end_time','','trim');
		$this->assign('start_time',$start_time);
		$this->assign('end_time',$end_time);
		$start_time=strtotime($start_time);
		$end_time=strtotime($end_time);
		
		if($s==3 && !empty($start_time) && !empty($end_time)){
			$stay['up_time'] = array(
				array(
					'egt',
					$start_time
					),
				array(
					'elt',
					$end_time
					)
				);
			
		}else if(!empty($start_time) && !empty($end_time)){
			
			$stay['add_time'] = array(
				array(
					'egt',
					$start_time
					),
				array(
					'elt',
					$end_time
					)
				);	
			
		}
		
		switch($s){
			case 3:
			$stay['status']=3;	
			break;
			case 1:	
			$stay['status']=1;	
			break;	
			case 2:	
			$stay['status']=2;	
			break;	
			default:
			break;
			
		}
		
		$prefix = C(DB_PREFIX);
		$field = '*,
		(select nickname from '.$prefix.'user where '.$prefix.'user.id = '.$prefix.'order.uid) as nickname';
		$rows = M('order')->field($field)->where($stay)->order('add_time desc')->limit($start . ',' . $page_size)->select();
		$count = M('order')->where($stay)->count();
		$pager = $this->_pager($count, $page_size);
		$this->assign('page', $pager->kshow());
		$this->assign('total_item', $count);
		$this -> assign('page_size',$page_size);
		$list=array();
		$webmaster_rate=$this->visitor->get('webmaster_rate');
		foreach($rows as $k=>$v){

			$cashback=round(($v['integral']*($this->fanxian/100))*($webmaster_rate/100),2);
			$income=round($v['income']*($webmaster_rate/100),2);

			$list[$k]['status']=$this->orderstatic($v['status']);
			$list[$k]['orderid']=$v['orderid'];
			$list[$k]['add_time']=date('m-d H:i:s',$v['add_time']);
			if($v['up_time']){
				$list[$k]['up_time']=date('m-d H:i:s',$v['up_time']);	
			}
			$list[$k]['goods_iid']=$v['goods_iid'];
			$list[$k]['goods_title']=$v['goods_title'];
			$list[$k]['income']=$income;
			$list[$k]['price']="￥".$v['price'];
			if($v['integral']){
				$list[$k]['cashback']=$cashback;
			}
			$list[$k]['payment']=round($income-$cashback,2);
			$list[$k]['nickname']=$v['nickname'];

		}
		$this->assign('list',$list);
		
		$this->_config_seo(array(
			'title'=>'订单列表'
			)); 
		$this->display();
	}

	protected function Fstatic($id){
		switch($id){
			case 2 :
			return '待付款';
			break;
			case 1 :
			return '已付款';
			break;
			default : 
			return '异常';
			break;
		}

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

	public function qrcode(){
		$data = C('yh_site_url').'/?trackid='.base64_encode($this->visitor->get('webmaster_pid'));
		$level = 'L';  
		$size = 4;
		vendor("phpqrcode.phpqrcode");
		$object = new QRcode();
		$object->png($data, false, $level, $size,0);
	}
	
// public function qrcode(){
// $value=C('yh_site_url').'/?trackid='.base64_encode($this->visitor->get('webmaster_pid'));
// vendor("phpqrcode.phpqrcode");
// $errorCorrectionLevel = 'H';
// $matrixPointSize = 6;
// $path=C("yh_attach_path").'site/';
// $filename=$path.$this->visitor->get('id')."_s.png";
// QRcode::png($value, $filename, $errorCorrectionLevel, $matrixPointSize, 2); 
// $logo = trim(C('yh_site_url')).$this->visitor->get('avatar');
// $QR = trim(C('yh_site_url')).'/'.$filename;
// if($logo !== FALSE && file_get_contents($logo))
// {
// $QR = imagecreatefromstring(file_get_contents($QR)); 
// $logo = imagecreatefromstring(file_get_contents($logo)); 
// $QR_width = imagesx($QR); 
// $QR_height = imagesy($QR); 
// $logo_width = imagesx($logo); 
// $logo_height = imagesy($logo); 
// $logo_qr_width = $QR_width / 5; 
// $scale = $logo_width / $logo_qr_width; 
// $logo_qr_height = $logo_height / $scale; 
// $from_width = ($QR_width - $logo_qr_width) / 2; 
// imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height); 
// }
// imagepng($QR,$path.$this->visitor->get('id').".png"); 
// } 	
	
	
	
	public function downfile()
	{
		$filpath=C("yh_attach_path").'site/'.$this->visitor->get('id').".png";
 $filename=realpath($filpath); //文件名
 $date=date("Ymd-H:i:m");
 Header( "Content-type:  application/octet-stream "); 
 Header( "Accept-Ranges:  bytes "); 
 Header( "Accept-Length: " .filesize($filename));
 header( "Content-Disposition:  attachment;  filename= {$date}.png"); 
 readfile($filename); 
 exit;
}


}

